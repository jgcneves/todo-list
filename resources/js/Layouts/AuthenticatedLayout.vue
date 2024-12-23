<script setup lang=ts>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import { Separator } from '@/Components/ui/separator'
import { Avatar, AvatarFallback, AvatarImage, } from '@/Components/ui/avatar'
import { Collapsible, CollapsibleContent, CollapsibleTrigger, } from '@/Components/ui/collapsible'
import { DropdownMenu, DropdownMenuContent, DropdownMenuGroup, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator, DropdownMenuTrigger, } from '@/Components/ui/dropdown-menu'
import { Sidebar, SidebarContent, SidebarGroup, SidebarGroupLabel, SidebarHeader, SidebarInset, SidebarMenu, SidebarMenuAction, SidebarMenuButton, SidebarMenuItem, SidebarMenuSub, SidebarMenuSubButton, SidebarMenuSubItem, SidebarProvider, SidebarRail, SidebarTrigger, } from '@/Components/ui/sidebar'
import { Search, Users, UserRound, AudioWaveform, BadgeCheck, BookOpen, Bot, ChevronRight, ChevronDown, Command, CreditCard, Folder, Forward, Frame, GalleryVerticalEnd, LogOut, MoreHorizontal, Settings2, Sparkles, SquareTerminal, Trash2, Bell, } from 'lucide-vue-next'


// This is sample data.
const data = {
    user: {
        name: 'shadcn',
        email: 'm@example.com',
        avatar: 'https://github.com/jgcneves.png',
    },
    teams: [
        {
            name: 'Acme Inc',
            logo: GalleryVerticalEnd,
            plan: 'Enterprise',
        },
        {
            name: 'Acme Corp.',
            logo: AudioWaveform,
            plan: 'Startup',
        },
        {
            name: 'Evil Corp.',
            logo: Command,
            plan: 'Free',
        },
    ],
    navMain: [
        {
            title: 'Playground',
            url: '#',
            icon: SquareTerminal,
            isActive: true,
            items: [
                {
                    title: 'History',
                    url: '#',
                },
                {
                    title: 'Starred',
                    url: '#',
                },
                {
                    title: 'Settings',
                    url: '#',
                },
            ],
        },
        {
            title: 'Models',
            url: '#',
            icon: Bot,
            items: [
                {
                    title: 'Genesis',
                    url: '#',
                },
                {
                    title: 'Explorer',
                    url: '#',
                },
                {
                    title: 'Quantum',
                    url: '#',
                },
            ],
        },
        {
            title: 'Documentation',
            url: '#',
            icon: BookOpen,
            items: [
                {
                    title: 'Introduction',
                    url: '#',
                },
                {
                    title: 'Get Started',
                    url: '#',
                },
                {
                    title: 'Tutorials',
                    url: '#',
                },
                {
                    title: 'Changelog',
                    url: '#',
                },
            ],
        },
        {
            title: 'Settings',
            url: '#',
            icon: Settings2,
            items: [
                {
                    title: 'General',
                    url: '#',
                },
                {
                    title: 'Team',
                    url: '#',
                },
                {
                    title: 'Billing',
                    url: '#',
                },
                {
                    title: 'Limits',
                    url: '#',
                },
            ],
        },
    ],
    projects: [
        {
            name: 'Default',
            url: '#',
            icon: Frame,
        },
        {
            name: 'Tasks',
            url: route('tasks.index'),
            icon: Users,
        },
    ],
}

const activeTeam = ref(data.teams[0])
</script>

<template>
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
                <SidebarGroup>
                    <SidebarGroupLabel> Platform </SidebarGroupLabel>
                    <SidebarMenu>
                        <Collapsible
                            v-for="item in data.navMain"
                            :key="item.title"
                            as-child
                            :default-open="item.isActive"
                            class="group/collapsible">
                            <SidebarMenuItem>
                                <CollapsibleTrigger as-child>
                                    <SidebarMenuButton :tooltip="item.title">
                                        <component :is="item.icon" />
                                        <span>{{ item.title }}</span>
                                        <ChevronRight class="ml-auto transition-transform duration-200 group-data-[state=open]/collapsible:rotate-90" />
                                    </SidebarMenuButton>
                                </CollapsibleTrigger>
                                <CollapsibleContent>
                                    <SidebarMenuSub>
                                        <SidebarMenuSubItem
                                            v-for="subItem in item.items"
                                            :key="subItem.title">
                                            <SidebarMenuSubButton as-child>
                                                <a :href="subItem.url">
                                                    <span>{{ subItem.title }}</span>
                                                </a>
                                            </SidebarMenuSubButton>
                                        </SidebarMenuSubItem>
                                    </SidebarMenuSub>
                                </CollapsibleContent>
                            </SidebarMenuItem>
                        </Collapsible>
                    </SidebarMenu>
                </SidebarGroup>

                <SidebarGroup class="group-data-[collapsible=icon]:hidden">
                    <SidebarGroupLabel> Projects </SidebarGroupLabel>
                    <SidebarMenu>
                        <SidebarMenuItem
                            v-for="item in data.projects"
                            :key="item.name">
                            <SidebarMenuButton as-child>
                                <a :href="item.url">
                                    <component :is="item.icon" />
                                    <span>{{ item.name }}</span>
                                </a>
                            </SidebarMenuButton>
                            <DropdownMenu>
                                <DropdownMenuTrigger as-child>
                                    <SidebarMenuAction show-on-hover>
                                        <MoreHorizontal />
                                        <span class="sr-only"> More </span>
                                    </SidebarMenuAction>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent class="w-48 rounded-lg" side="bottom" align="end">
                                    <DropdownMenuItem>
                                        <Folder class="text-muted-foreground" />
                                        <span> View Project </span>
                                    </DropdownMenuItem>
                                    <DropdownMenuItem>
                                        <Forward class="text-muted-foreground" />
                                        <span> Share Project </span>
                                    </DropdownMenuItem>
                                    <DropdownMenuSeparator />
                                    <DropdownMenuItem>
                                        <Trash2 class="text-muted-foreground" />
                                        <span> Delete Project </span>
                                    </DropdownMenuItem>
                                </DropdownMenuContent>
                            </DropdownMenu>
                        </SidebarMenuItem>
                        <SidebarMenuItem>
                            <SidebarMenuButton class="text-sidebar-foreground/70">
                                <MoreHorizontal class="text-sidebar-foreground/70" />
                                <span> More </span>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    </SidebarMenu>
                </SidebarGroup>
            </SidebarContent>

            <!--
            <SidebarFooter>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <DropdownMenu>
                            <DropdownMenuTrigger as-child>
                                <SidebarMenuButton size="lg" class="data-[state=open]:bg-sidebar-accent data-[state=open]:text-sidebar-accent-foreground">
                                    <Avatar class="h-8 w-8 rounded-lg">
                                        <AvatarImage :src="data.user.avatar" :alt="data.user.name" />
                                        <AvatarFallback class="rounded-lg"> CN </AvatarFallback>
                                    </Avatar>
                                    <div class="grid flex-1 text-left text-sm leading-tight">
                                        <span class="truncate font-semibold">{{ data.user.name }}</span>
                                        <span class="truncate text-xs">{{ data.user.email }}</span>
                                    </div>
                                    <ChevronsUpDown class="ml-auto size-4" />
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
                                            <span class="truncate font-semibold">{{ data.user.name }}</span>
                                            <span class="truncate text-xs">{{ data.user.email }}</span>
                                        </div>
                                    </div>
                                </DropdownMenuLabel>
                                <DropdownMenuSeparator />
                                <DropdownMenuGroup>
                                    <DropdownMenuItem>
                                        <Sparkles />
                                        Upgrade to Pro
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
                                    <LogOut />
                                    Log out
                                </DropdownMenuItem>
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarFooter>
            -->

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

                        <!--
                        <div class="flex flex-1">
                            <form class="flex w-full md:ml-0" action="#" method="GET">
                                <label for="search-field" class="sr-only"> Search </label>
                                <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center">
                                        <Search class="h-5 w-5"/>
                                    </div>
                                    <input id="search-field" class="block h-full w-full border-transparent py-2 pl-8 pr-3 text-gray-900 placeholder-gray-500 focus:border-transparent focus:placeholder-gray-400 focus:outline-none focus:ring-0 sm:text-sm" placeholder="Search" type="search" name="search" />
                                </div>
                            </form>
                        </div>
                        -->

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

                <main class="hidden h-full flex-1 flex-col space-y-8 p-6 md:flex">
                    <slot />
                </main>
            </div>
        </SidebarInset>
    </SidebarProvider>
</template>
