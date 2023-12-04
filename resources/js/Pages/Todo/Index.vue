<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import {ref} from "vue";
import {Link, useForm} from '@inertiajs/vue3';
import {router} from "@inertiajs/vue3";
import Button from "@/Components/Button.vue";
import {ButtonColors} from "@/enums/ButtonColors";

const props = defineProps<{
    todos: Todo[]
}>();

const form = useForm({
    errors: {
        nome: [],
    },
});

const title = ref<string>("Lista de Tarefas");

const destroy = (id:number) => {
    if (confirm("Tem certeza que deseja excluir?")) {
        router.delete(route('todos.destroy', {'todo': id}));
    }
}
</script>

<template>
    <AppLayout :title="title">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ title }}
            </h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-5">
                    <Link :href="route('todos.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Adicionar</Link>
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th class="px-3 py-2 text-left bg-slate-50 text-slate-500 border-slate-100">ID</th>
                                <th class="px-3 py-2 text-left bg-slate-50 text-slate-500 border-slate-100">Nome</th>
                                <th class="px-3 py-2 text-left bg-slate-50 text-slate-500 border-slate-100">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="todo in todos">
                                <td class="border-t-0 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap px-3 py-2">{{ todo.id }}</td>
                                <td class="border-t-0 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap px-3 py-2">{{ todo.nome }}</td>
                                <td class="border-t-0 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap px-3 py-2">
                                    <div class="flex">
                                        <Link :href="route('todos.edit', {'todo': todo.id})" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-3 mr-3">Editar</Link>
                                        <Button v-on:meu-click="destroy(todo.id)" :cor="ButtonColors.red">Excluir</Button>
                                        <!--<form @submit.prevent="form.delete(route('todos.destroy', {'todo': todo.id}))">
                                            <span v-if="form.errors.nome" class="text-red-500 text-xs italic">{{ form.errors.nome }}</span>
                                            <br v-if="form.errors.nome">
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2 mr-2">Excluir</button>
                                        </form>-->
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>