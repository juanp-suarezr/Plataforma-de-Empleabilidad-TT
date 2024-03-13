<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import SecondaryButton from "@/Components/SecondaryButton.vue";
import MultiSelect from 'primevue/multiselect';
import { inject } from 'vue';

const swal = inject('$swal');

const props = defineProps({
    roles: {
        type: Object,
        default: () => ({}),
    }
});

const form = useForm({
    titulo: '',
    descripcion: '',
    horarios: '',
    jornada: '',
    modalidad_trabajo: '',
    tipo_contrato: '',
    categoria: '',
    cargo: '',
    ubicacion: '',
    salario: ''
});

const submit = () => {
    form.post(route('ofertas.store'), {
        onSuccess: function () {
            // form.reset('password', 'password_confirmation');
            swal({
                title: "Registro Guardado",
                text: "La oferta se ha almacenado exitosamente",
                icon: "success"
            })
        }
    });
};

</script>

<template>
    <Head title="Nueva Oferta" />

    <AuthenticatedLayout>
        <template #header>
            <Link class="text-indigo-400 hover:text-indigo-600" href="/ofertas"> Ofertas </Link> / {{ form.name }}
        </template>

        <div class="flex flex-col bg-white border shadow-sm rounded-xl lg:w-1/2 md:w-2/3">
            <div class="bg-gray-100 border-b rounded-t-xl py-3 px-4 md:py-4 md:px-5 grid grid-cols-2 gap-4">
                <h3 class="mt-1 text-gray-500">
                    Nueva Oferta laboral
                </h3>
                <div class="text-right">
                    <SecondaryButton :href="route('ofertas.index')">
                        Regresar
                    </SecondaryButton>
                </div>

            </div>
            <div class="p-4 md:p-5">
                <form @submit.prevent="submit" class="grid lg:grid-cols-2 gap-4">
                    <div>
                        <InputLabel for="titulo" value="Titulo de la oferta" />
                        <TextInput id="titulo" type="text" class="mt-1 block w-full" v-model="form.titulo" required autofocus
                            autocomplete="titulo" />
                        <InputError class="mt-2" :message="form.errors.titulo" />
                    </div>

                    <div>
                        <InputLabel for="descripcion" value="Descripción del cargo" />
                        <TextInput id="descripcion" type="text" class="mt-1 block w-full" v-model="form.descripcion" required
                            autocomplete="descripcion" />
                        <InputError class="mt-2" :message="form.errors.descripcion" />
                    </div>
                    <div>
                        <InputLabel for="horarios" value="Horario" />
                        <TextInput id="horarios" type="text" class="mt-1 block w-full" v-model="form.horarios" required
                            autocomplete="horarios" />
                        <InputError class="mt-2" :message="form.errors.horarios" />
                    </div>

                    <div>
                        <InputLabel for="jornada" value="Jornada" />
                        <TextInput id="jornada" type="text" class="mt-1 block w-full" v-model="form.jornada" required
                            autocomplete="jornada" />
                        <InputError class="mt-2" :message="form.errors.jornada" />
                    </div>
                    <div>
                        <InputLabel for="modalidad_trabajo" value="Modalidad de trabajo" />
                        <TextInput id="modalidad_trabajo" type="text" class="mt-1 block w-full" v-model="form.modalidad_trabajo" required
                            autocomplete="modalidad_trabajo" />
                        <InputError class="mt-2" :message="form.errors.modalidad_trabajo" />
                    </div>
                    <div>
                        <InputLabel for="tipo_contrato" value="Tipo de contrato" />
                        <TextInput id="tipo_contrato" type="text" class="mt-1 block w-full" v-model="form.tipo_contrato" required
                            autocomplete="tipo_contrato" />
                        <InputError class="mt-2" :message="form.errors.tipo_contrato" />
                    </div>
                    <div>
                        <InputLabel for="categoria" value="Categoria" />
                        <TextInput id="categoria" type="text" class="mt-1 block w-full" v-model="form.categoria" required
                            autocomplete="categoria" />
                        <InputError class="mt-2" :message="form.errors.categoria" />
                    </div>
                    <div>
                        <InputLabel for="cargo" value="Cargo" />
                        <TextInput id="cargo" type="text" class="mt-1 block w-full" v-model="form.cargo" required
                            autocomplete="cargo" />
                        <InputError class="mt-2" :message="form.errors.cargo" />
                    </div>
                    <div>
                        <InputLabel for="ubicacion" value="Ubicacion" />
                        <TextInput id="ubicacion" type="text" class="mt-1 block w-full" v-model="form.ubicacion" required
                            autocomplete="ubicacion" />
                        <InputError class="mt-2" :message="form.errors.ubicacion" />
                    </div>
                    <div>
                        <InputLabel for="salario" value="Salario" />
                        <TextInput id="salario" type="text" class="mt-1 block w-full" v-model="form.salario" required
                            autocomplete="salario" />
                        <InputError class="mt-2" :message="form.errors.salario" />
                    </div>

                    <div>
                        <div class="mt-4 flex flex-col items-end">
                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Registrar Usuario
                            </PrimaryButton>

                        </div>
                    </div>

                </form>

            </div>
        </div>
    </AuthenticatedLayout>
</template>