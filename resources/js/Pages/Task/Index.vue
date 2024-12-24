<script setup lang="ts">
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, } from '@/Components/ui/dialog'
    import { FormControl, FormField, FormItem, FormLabel, FormMessage, } from '@/Components/ui/form'
    import { Card, CardContent, CardHeader, CardTitle, } from '@/Components/ui/card'
    import { Input } from '@/Components/ui/input'
    import { Button } from '@/Components/ui/button'
    import { router } from '@inertiajs/vue3'

    import { useForm } from 'vee-validate'
    import { toTypedSchema } from '@vee-validate/zod'
    import * as z from 'zod'

    import { ref } from 'vue'
    import axios from 'axios'
    import { Pencil, Plus, Save, Trash2, } from 'lucide-vue-next'

    import { useToast } from '@/Components/ui/toast/use-toast'
    const { toast } = useToast()

    defineProps({
        tasks: {
            type: Array
        }
    })

    const isCreateTaskDialogOpen = ref(false)
    const isDeleteTaskDialogOpen = ref(false)
    const currentTaskId = ref<number | null>(null)

    const formSchema = toTypedSchema(z.object({
        title: z.string().min(2).max(255),
        // status: z.boolean().default(false).optional(),
    }))

    const { setFieldError, handleSubmit, } = useForm({
        validationSchema: formSchema,
    })

    // Submit form
    const onSubmit = handleSubmit((values) => {

        const payload = {
            ...values,
            status: false,
        };

        axios.post(route('tasks.store'), payload)
            .then(function (response) {
                isCreateTaskDialogOpen.value = false
                toast({
                    title: 'The task was created successfully!',
                })
            })
            .catch(function (error) {
                Object.entries(error).forEach(([field, message]) => {
                    setFieldError(field, message);
                })
            })
    })

    // Update task
    function onUpdate(id: number) {
        router.put(route('tasks.update', {id}), 'asd',{
            onSuccess(response) {

                toast({
                    title: 'The task was deleted successfully!',
                })
            },
            onError(response) {
                console.error(response)
            }
        })
    }

    function handleCheckboxChange(event, id: number) {
        const value = event.target.value;
        const status = event.target.checked;

        router.put(route('tasks.update', {id}), {
            status: status,
        },{
            onSuccess(response) {
                toast({
                    title: 'The task status was updated successfully!',
                })
            },
            onError(response) {
                console.log(response)
            }
        })

        console.log(`ID: ${id}, Value: ${value}, Checked: ${status}`);
        // Aqui você pode manipular os dados como desejar
    }



    const openDeleteDialog = (id: number) => {
        currentTaskId.value = id
        isDeleteTaskDialogOpen.value = true
    }

    const onDelete = (id: number | null) => {
        if (id !== null) {
            router.delete(route('tasks.destroy', {id}), {
                onSuccess(response) {
                    toast({
                        title: 'The task was deleted successfully!',
                    })
                },
                onError(response) {
                    console.error(response)
                }
            })
        }

        isDeleteTaskDialogOpen.value = false
    }
</script>
<template>
    <AuthenticatedLayout>
        <!-- Modal task delete -->
        <Dialog v-model:open="isDeleteTaskDialogOpen">
            <DialogContent class="sm:max-w-[50%]">
                <DialogHeader>
                    <DialogTitle>Confirm Deletion</DialogTitle>
                    <DialogDescription>
                        Are you sure you want to delete this item? This action cannot be undone.
                    </DialogDescription>
                </DialogHeader>
                <DialogFooter>
                    <Button variant="outline" @click="isDeleteTaskDialogOpen = false">
                        Cancel
                    </Button>
                    <Button variant="destructive" @click="onDelete(currentTaskId)">
                        <Trash2 />
                        Yes, Delete!
                    </Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>

        <!-- Modal task create -->
        <Dialog v-model:open="isCreateTaskDialogOpen">
            <DialogContent class="sm:max-w-[50%]">
                <DialogHeader>
                    <DialogTitle> Create a new task </DialogTitle>
                    <DialogDescription>
                        Enter the task name here. Click save when you're done.
                    </DialogDescription>
                </DialogHeader>

                <form @submit="onSubmit">
                    <FormField v-slot="{ componentField }" name="title">
                        <FormItem>
                            <FormLabel> Title </FormLabel>
                            <FormControl>
                                <Input type="text" placeholder="Enter your task" v-bind="componentField" />
                            </FormControl>
                            <FormMessage />
                        </FormItem>
                    </FormField>

                    <Button type="submit" class="mt-3">
                        <Save />
                        Save
                    </Button>
                </form>


            </DialogContent>
        </Dialog>

        <!-- Title -->
        <div class="mt-2 md:flex md:items-center md:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight dark:text-white">
                    Tasks
                </h2>
            </div>
            <div class="mt-4 flex flex-shrink-0 md:mt-0 md:ml-4">

                    <Button @click="isCreateTaskDialogOpen = true" class="flex items-center gap-2">
                        <Plus class="size-4"/> Add Task
                    </Button>
            </div>
        </div>

        <!-- Content -->
        <Card class="w-100">
            <CardHeader>
                <CardTitle> Tasks Pending </CardTitle>
            </CardHeader>
            <CardContent>
                <div v-for="task in tasks" :key="task.status == 0">
                    <div v-if="task.status === 0" class="items-center flex px-4 py-2 gap-2 hover:bg-gray-50 justify-between rounded" >
                        <div class="flex items-center gap-2">
                            <input
                                class="size-6"
                                type="checkbox"
                                :id="task.id"
                                :value="task.status"
                                @change="handleCheckboxChange($event, task.id)"
                            />
                            <div class="grid gap-1.5 leading-none">
                                <label :for="task.id" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                    {{ task.title }}
                                </label>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <Button size="icon" variant="secondary">
                                <Pencil />
                            </Button>

                            <Button size="icon" variant="destructive" @click="openDeleteDialog(task.id)">
                                <Trash2 />
                            </Button>
                        </div>
                    </div>
                </div>
            </CardContent>
        </Card>

        <Card class="w-100">
            <CardHeader>
                <CardTitle> Tasks Completed </CardTitle>
            </CardHeader>
            <CardContent>
                <div v-for="task in tasks" :key="task.id">
                    <div v-if="task.status === 1" class="items-center flex px-4 py-2 gap-2 hover:bg-gray-50 justify-between rounded" >
                        <div class="flex items-center gap-2 line-through">
                            <input
                                class="size-6 rounded-md bg-red-500"
                                type="checkbox"
                                :id="task.id"
                                :value="task.status"
                                @change="handleCheckboxChange($event, task.id)"
                                :checked="task.status"
                            />
                            <div class="grid gap-1.5 leading-none">
                                <label :for="task.id" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                    {{ task.title }}
                                </label>
                            </div>
                        </div>

                        <Button size="icon" variant="destructive" @click="openDeleteDialog(task.id)">
                            <Trash2 />
                        </Button>
                    </div>
                </div>
            </CardContent>
        </Card>
    </AuthenticatedLayout>
</template>
