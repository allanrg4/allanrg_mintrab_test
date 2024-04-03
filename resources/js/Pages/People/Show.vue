<script setup>
import {ref} from "vue";

import Layout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import StatusBadge from "@/Components/People/StatusBadge.vue";

const props = defineProps(['person', 'document_url', 'is_technical'])

const confirm = ref()
const actions = useForm({
    action: '',
})

function getFullName(item) {
    return [
        item.first_name,
        item.second_name,
        item.first_surname,
        item.second_surname,
        item.married_surname ? `de ${item.married_surname}` : '',
    ].join(' ')
}

function onSubmit() {
    const options = {
        onFinish: () => {
            confirm.value.close()
        }
    }

    if (actions.action === 'approve') {
        actions.patch(route('people.approve', props.person.id), options)
    }

    if (actions.action === 'reject') {
        actions.patch(route('people.reject', props.person.id), options)
    }

    if (actions.action === 'destroy') {
        actions.delete(route('people.destroy', props.person.id), options)
    }
}
</script>

<template>
    <Layout>
        <Head title="Detalle" />

        <div class="w-1/2">
            <div class="flex items-center gap-2">
                <StatusBadge :status="person.status"/>

                <span class="font-black text-2xl">
                    {{ getFullName(person) }}
                </span>
            </div>

            <p class="divider divider-start">
                Información Personal
            </p>

            <p><span class="font-bold">Nombre</span>: {{ person.first_name }}</p>
            <p><span class="font-bold">Segundo Nombre</span>: {{ person.second_name ?? 'No registrado' }}</p>
            <p><span class="font-bold">Primer Apellido</span>: {{ person.first_surname }}</p>
            <p><span class="font-bold">Segundo Apellido</span>: {{ person.second_surname ?? 'No registrado' }}</p>
            <p><span class="font-bold">Apellido de Casada</span>: {{ person.married_surname ?? 'No registrado' }}</p>
            <p><span class="font-bold">Fecha de Nacimiento</span>: {{ person.birthdate ?? 'No registrado' }}</p>
            <p><span class="font-bold">Genero</span>: {{ person.gender === 'MALE' ? 'Masculino' : 'Femenino' }}</p>

            <p class="divider divider-start">
                Información de Contacto
            </p>

            <p><span class="font-bold">Correo Electronico</span>: {{ person.email ?? 'No registrado' }}</p>
            <p><span class="font-bold">Número Telefonico</span>: {{ person.phone_number ?? 'No registrado' }}</p>
            <p><span class="font-bold">Dirección</span>: {{ person.address ?? 'No registrado' }}</p>

            <p class="divider divider-start">
                Información de Documento
            </p>

            <p><span class="font-bold">Estado Civil</span>: {{ person.civil_status }}</p>
            <p><span class="font-bold">Tipo de documento</span>: {{ person.document_type }}</p>
            <a
                :href="document_url"
                target="_blank"
                class="btn"
            >
                Descargar Documento
            </a>

            <p class="divider divider-start">
                Acciones
            </p>

            <div class="flex gap-4">
                <button
                    v-if="is_technical"
                    class="btn"
                    @click="actions.action = 'approve'; confirm.showModal()"
                >
                    Aprobar
                </button>

                <button
                    v-if="is_technical"
                    class="btn"
                    @click="actions.action = 'reject'; confirm.showModal()"
                >
                    Rechazar
                </button>

                <Link
                    :href="route('people.edit', person.id)"
                    class="btn btn-ghost"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>

                </Link>

                <button
                    class="btn btn-error text-white"
                    @click="actions.action = 'destroy'; confirm.showModal()"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </button>
            </div>
        </div>
    </Layout>

    <dialog ref="confirm" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">
                Confirmación
            </h3>

            <p class="py-4">
                ¿Estas seguro de realizar esta operación?
            </p>


            <form @submit.prevent="onSubmit" class="modal-action">
                <button type="submit" class="btn btn-success text-white">
                    Aceptar
                </button>

                <button
                    type="button"
                    class="btn"
                    @click.prevent="confirm.close()"
                >
                    Cancelar
                </button>
            </form>
        </div>
    </dialog>
</template>
