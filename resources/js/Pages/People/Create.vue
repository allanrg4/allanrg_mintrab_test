<script setup>
import Layout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

import {Head, Link, useForm} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    first_name: '',
    second_name: '',
    first_surname: '',
    second_surname: '',
    married_surname: '',
    document_type: '',
    file: '',
    birthdate: '',
    phone_number: '',
    email: '',
    gender: '',
    civil_status: '',
    address: '',
});

function submit() {
    form.post(route('people.store'));
}
</script>

<template>
    <Layout>
        <Head title="Persona" />

        <template #header>
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">
                    Creación de Persona
                </h1>
            </div>
        </template>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="first_name" value="Primer Nombre (Requerido)" />

                <TextInput
                    id="first_name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.first_name"
                    required
                    autofocus
                />

                <InputError class="mt-2" :message="form.errors.first_name" />
            </div>

            <div>
                <InputLabel for="second_name" value="Segundo Nombre" />

                <TextInput
                    id="second_name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.second_name"
                />

                <InputError class="mt-2" :message="form.errors.second_name" />
            </div>

            <div>
                <InputLabel for="first_surname" value="Primer Apellido (Requerido)" />

                <TextInput
                    id="first_surname"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.first_surname"
                    required
                />

                <InputError class="mt-2" :message="form.errors.first_surname" />
            </div>

            <div>
                <InputLabel for="second_surname" value="Segundo Apellido" />

                <TextInput
                    id="second_name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.second_surname"
                />

                <InputError class="mt-2" :message="form.errors.second_surname" />
            </div>

            <div>
                <InputLabel for="married_surname" value="Apellido de Casada" />

                <TextInput
                    id="married_surname"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.married_surname"
                />

                <InputError class="mt-2" :message="form.errors.married_surname" />
            </div>

            <div>
                <InputLabel for="document_type" value="Tipo de Documento (Requerido)" />

                <select
                    id="document_type"
                    type="text"
                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                    v-model="form.document_type"
                    required
                >
                    <option value="CUI">
                        CUI
                    </option>

                    <option value="PASSPORT">
                        Pasaporte
                    </option>
                </select>

                <InputError class="mt-2" :message="form.errors.document_type" />
            </div>

            <div>
                <InputLabel for="file" value="Documento" />

                <input
                    id="file"
                    type="file"
                    class="file-input file-input-bordered border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                    @input="form.file = $event.target.files[0]"
                    accept="application/pdf"
                />

                <InputError class="mt-2" :message="form.errors.file" />
            </div>

            <div>
                <InputLabel for="birthdate" value="Fecha de Nacimiento" />

                <TextInput
                    id="birthdate"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="form.birthdate"
                />

                <InputError class="mt-2" :message="form.errors.birthdate" />
            </div>

            <div>
                <InputLabel for="phone_number" value="Número de Teléfono" />

                <TextInput
                    id="phone_number"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.phone_number"
                />

                <InputError class="mt-2" :message="form.errors.phone_number" />
            </div>

            <div>
                <InputLabel for="email" value="Correo Electroníco" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div>
                <InputLabel for="gender" value="Genero (Requerido)" />

                <select
                    id="gender"
                    type="text"
                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                    v-model="form.gender"
                    required
                >
                    <option value="MALE">
                        Masculino
                    </option>

                    <option value="FEMALE">
                        Femenino
                    </option>
                </select>

                <InputError class="mt-2" :message="form.errors.gender" />
            </div>

            <div>
                <InputLabel for="civil_status" value="Estado Civil (Requerido)" />

                <select
                    id="civil_status"
                    type="text"
                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                    v-model="form.civil_status"
                    required
                >
                    <option value="SINGLE">
                        Soltero (a)
                    </option>

                    <option value="MARRIED">
                        Casado (a)
                    </option>

                    <option value="DIVORCED">
                        Divorciado (a)
                    </option>

                    <option value="WIDOWED">
                        Viudo (a)
                    </option>
                </select>

                <InputError class="mt-2" :message="form.errors.civil_status" />
            </div>

            <div>
                <InputLabel for="address" value="Dirección" />

                <TextInput
                    id="email"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.address"
                />

                <InputError class="mt-2" :message="form.errors.address" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Crear Persona
                </PrimaryButton>
            </div>
        </form>
    </Layout>
</template>
