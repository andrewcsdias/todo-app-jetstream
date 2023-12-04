<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import {ref} from "vue";
import {useForm} from '@inertiajs/vue3'

const props = defineProps<{
    todo: Todo
}>();

const form = useForm({
    nome: props.todo.nome,
    errors: {
        nome: [],
    },
});

const title = ref<string>('Editar Tarefa: ' + props.todo.nome);

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
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="form.put(route('todos.update', {'todo': todo.id}))">
                        <div class="md:flex md:items-center my-3">
                            <div class="md:w-1/12">
                                <label class="block uppercase text-slate-600 text-xs font-bold mb-2" for="nome">Nome:</label>
                            </div>
                            <div class="md:w-11/12">
                                <input v-model="form.nome" type="text" name="nome" id="nome" class="px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
                            </div>
                        </div>
                        <span v-if="form.errors.nome" class="text-red-500 text-xs italic">{{ form.errors.nome }}</span>
                        <br v-if="form.errors.nome">
                        <div class="flex justify-center">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-2 flex justify-center">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>