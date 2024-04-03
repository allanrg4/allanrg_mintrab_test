<script setup>
import Layout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

import StatusBadge from "@/Components/People/StatusBadge.vue";

defineProps(['people'])

function getFullName(item) {
    return [
        item.first_name,
        item.second_name,
        item.first_surname,
        item.second_surname,
        item.married_surname ? `de ${item.married_surname}` : '',
    ].join(' ')
}
</script>

<template>
    <Layout>
        <Head title="Listado" />

        <template #header>
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">
                    Listado de personas
                </h1>

                <Link
                    :href="route('people.create')"
                    class="btn"
                >
                    Crear persona
                </Link>
            </div>
        </template>

        <div class="container mx-auto">
            <table
                v-if="people.length > 0"
                class="table table-zebra"
            >
                <thead>
                    <tr>
                        <th></th>
                        <th>Nombre</th>
                        <th>Correo Electronico</th>
                        <th>Número Telefonico</th>
                        <th>Genero</th>
                        <th>Status</th>
                        <th class="text-right">Aciones</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="(item, index) in people" :key="item.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ getFullName(item) }}</td>
                        <td>{{ item.email ?? 'No registrado' }}</td>
                        <td>{{ item.phone_number ?? 'No registrado' }}</td>
                        <td>{{ item.gender === 'MALE' ? 'Masculino' : 'Femenino' }}</td>

                        <td><StatusBadge :status="item.status"/></td>

                        <th class="flex justify-end">
                            <Link
                                :href="route('people.show', item.id)"
                                class="btn btn-ghost"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </Link>
                        </th>
                    </tr>
                </tbody>
            </table>

            <span
                v-else
                class="text-2xl"
            >
                No hay personas registradas.
            </span>
        </div>
    </Layout>
</template>
