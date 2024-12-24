<script setup lang=ts>
import { Link } from '@inertiajs/vue3'
import { Separator } from '@/Components/ui/separator'
import { Avatar, AvatarFallback, AvatarImage, } from '@/Components/ui/avatar'
import { DropdownMenu, DropdownMenuContent, DropdownMenuGroup, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator, DropdownMenuTrigger, } from '@/Components/ui/dropdown-menu'
import { Sidebar, SidebarContent, SidebarGroup, SidebarGroupLabel, SidebarHeader, SidebarInset, SidebarMenu, SidebarMenuButton, SidebarMenuItem, SidebarProvider, SidebarRail, SidebarTrigger, } from '@/Components/ui/sidebar'
import { Home, ListTodo, UserRound, BadgeCheck, ChevronDown, CreditCard, LogOut, Sparkles, Bell, } from 'lucide-vue-next'

import { Toaster } from '@/Components/ui/toast'

// This is sample data.
const data = {
    user: {
        name: 'shadcn',
        email: 'm@example.com',
        avatar: 'https://github.com/jgcneves.png',
    },
    projects: [
        {
            name: 'Dashboard',
            url: route('dashboard'),
            icon: Home,
        },
        {
            name: 'Tasks',
            url: route('tasks.index'),
            icon: ListTodo,
        },
    ],
}

</script>

<template>
    <Toaster />
    <SidebarProvider>

        <!-- Sidebar Menu -->
        <Sidebar variant="sidebar" side="left" collapsible="icon">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <img class="size-8 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=300" alt="Your Company" />
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <SidebarGroup class="group-data-[collapsible=icon]:hidden">
                    <SidebarGroupLabel> Projects </SidebarGroupLabel>
                    <SidebarMenu>
                        <SidebarMenuItem
                            v-for="item in data.projects"
                            :key="item.name">
                            <SidebarMenuButton as-child>
                                <Link :href="item.url">
                                    <component :is="item.icon" />
                                    <span>{{ item.name }}</span>
                                </Link>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    </SidebarMenu>
                </SidebarGroup>
            </SidebarContent>
            <SidebarRail />
        </Sidebar>

        <!-- Content -->
        <SidebarInset class="bg-gray-50">
            <div class="flex flex-1 flex-col">
                <div class="sticky items-center top-0 z-10 flex h-16 flex-shrink-0 bg-background px-6 shadow-sm">
                    <button type="button" class="px-4 text-gray-500">
                        <span class="sr-only"> Open sidebar </span>
                        <SidebarTrigger class="-ml-1 size-6" />
                    </button>

                    <Separator orientation="vertical" class="mx-4 h-4" />

                    <div class="flex flex-1 justify-end">

                        <div class="flex items-center ml-2 md:ml-4">

                            <button type="button" class="rounded-full bg-white p-2 text-gray-400 hover:text-gray-500">
                                <span class="sr-only"> View notifications </span>
                                <Bell class="size-4" aria-hidden="true" />
                            </button>

                            <Separator orientation="vertical" class="mx-4 h-4" />

                            <!-- Profile dropdown -->
                            <DropdownMenu>
                                <DropdownMenuTrigger as-child>
                                    <SidebarMenuButton size="lg" class="data-[state=open]:bg-sidebar-accent data-[state=open]:text-sidebar-accent-foreground">
                                        <Avatar class="h-8 w-8 rounded-lg">
                                            <AvatarImage :src="data.user.avatar" :alt="data.user.name" />
                                            <AvatarFallback class="rounded-lg"> CN </AvatarFallback>
                                        </Avatar>
                                        <div class="grid flex-1 text-left text-sm leading-tight">
                                            <span class="truncate font-semibold">{{ $page.props.auth.user.name ?? 'John Doe' }}</span>
                                        </div>
                                        <ChevronDown class="ml-auto size-4 group-data-[state=open]/collapsible:rotate-90" />
                                    </SidebarMenuButton>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent class="w-[--radix-dropdown-menu-trigger-width] min-w-56 rounded-lg" side="bottom" align="end" :side-offset="4">
                                    <DropdownMenuLabel class="p-0 font-normal">
                                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                            <Avatar class="h-8 w-8 rounded-lg">
                                                <AvatarImage :src="data.user.avatar" :alt="data.user.name" />
                                                <AvatarFallback class="rounded-lg"> CN </AvatarFallback>
                                            </Avatar>
                                            <div class="grid flex-1 text-left text-sm leading-tight">
                                                <span class="truncate font-semibold">{{ $page.props.auth.user.name ?? 'John Doe' }}</span>
                                                <span class="truncate text-xs">{{ $page.props.auth.user.email ?? 'John Doe' }}</span>
                                            </div>
                                        </div>
                                    </DropdownMenuLabel>

                                    <DropdownMenuSeparator />

                                    <DropdownMenuGroup>
                                        <DropdownMenuItem>
                                            <Sparkles />
                                            Upgrade Plan
                                        </DropdownMenuItem>
                                    </DropdownMenuGroup>

                                    <DropdownMenuSeparator />

                                    <DropdownMenuGroup>
                                        <DropdownMenuItem>
                                            <UserRound />
                                            Profile
                                        </DropdownMenuItem>

                                        <DropdownMenuItem>
                                            <BadgeCheck />
                                            Account
                                        </DropdownMenuItem>

                                        <DropdownMenuItem>
                                            <CreditCard />
                                            Billing
                                        </DropdownMenuItem>

                                        <DropdownMenuItem>
                                            <Bell />
                                            Notifications
                                        </DropdownMenuItem>
                                    </DropdownMenuGroup>

                                    <DropdownMenuSeparator />

                                    <DropdownMenuItem>
                                        <Link
                                            :href="route('logout')"
                                            class="flex items-center gap-2"
                                            method="post"
                                            as="button">
                                            <LogOut class="size-4" />
                                            Log out
                                        </Link>
                                    </DropdownMenuItem>
                                </DropdownMenuContent>
                            </DropdownMenu>
                        </div>
                    </div>
                </div>

                <main class="h-full flex-1 flex-col space-y-8 p-6 flex">
                    <slot />
                </main>
            </div>
        </SidebarInset>
    </SidebarProvider>
</template>
