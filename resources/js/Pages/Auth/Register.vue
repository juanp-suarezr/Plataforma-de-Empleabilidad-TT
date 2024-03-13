<template>

    <Head title="Register" />

    <GuestLayout :isRegister=true>
        <Link href="/" class="flex items-center justify-center">
        <ApplicationLogo class="w-2/6 fill-current text-gray-500" />
        </Link>

        <form @submit.prevent="submit">
            <div class="card flex justify-content-center mx-6 z-10 gap-4">
                <p class="text-lg md:text-2xl mt-4 text-white">Registrarse como</p>
                <button @click="checked = !checked" class="rounded-xl p-2"
                    :class="checked ? 'bg-sky-500' : 'bg-sky-800'">
                    <p v-if="checked == false" class="text-white">
                        Campista
                    </p>
                    <p v-else class="text-white">
                        Empresa
                    </p>
                </button>
            </div>

            <div class="sm:grid grid-cols-2 gap-4 mt-6">

                <!-- nombre -->
                <div class="mb-2">
                    <InputLabel for="name" value="Nombre" class="text-white" />
                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                        autocomplete="name" />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <!-- identificacion -->
                <div class="mb-2">
                    <InputLabel for="identificacion" :value="checked ? 'NIT' : 'Identificación'" class="text-white" />
                    <TextInput id="identificacion" type="text" class="mt-1 block w-full" v-model="form.identificacion"
                        required autofocus autocomplete="identificacion" />
                    <InputError class="mt-2" :message="form.errors.identificacion" />
                </div>
                <!-- telefono -->
                <div class="mb-2">
                    <InputLabel for="telefono" value="Telefono" class="text-white" />
                    <TextInput id="telefono" type="text" class="mt-1 block w-full" v-model="form.telefono" required
                        autofocus autocomplete="telefono" />
                    <InputError class="mt-2" :message="form.errors.telefono" />
                </div>
                <!-- departamento -->
                <div class="mb-2">
                    <InputLabel for="departamento" value="Departamento" class="text-white" />
                    <select id="departamento" name="deparatamento" v-model="deparatamentoSelect"
                        class="block w-full px-4 py-2 mt-1 text-base text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500">

                        <option class="text-black" v-for="dep in nomDepart" :key="dep.id" :value="dep.departamento">{{
        dep.departamento }}
                        </option>
                    </select>
                </div>
                <!-- email -->
                <div class="mb-2">
                    <InputLabel for="email" value="Email" class="text-white" />
                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                        autocomplete="username" />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mb-2">
                    <InputLabel for="password" value="Password" class="text-white" />
                    <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                        autocomplete="new-password" />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mb-2">
                    <InputLabel for="password_confirmation" value="Confirm Password" class="text-white" />
                    <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                        v-model="form.password_confirmation" required autocomplete="new-password" />
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

            </div>

            <div class="mt-4 flex flex-col items-center">
                <PrimaryButton class="w-2/6" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>

                <Link :href="route('login')" class="mt-4 text-sm text-gray-400 underline hover:border-b">
                ¿Ya estas registrado?
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue'

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const props = defineProps({
    resultados: {
        type: Object,
        default: () => ({}),
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
});

console.log(props.resultados);

//checked para empresas o campistas
const checked = ref(false);
//select departamentos
const deparatamentoSelect = ref("");
//array con departamentos
const nomDepart = ref([{ departamento: 'Nariño' },
{ departamento: 'Cauca' },]);

//array con departamentos
const nomMuni = ref([]);

//Cambiar form
watch(checked, (value) => {

    nomDepart.value = [];
    let dep1 = true;
    let dep2 = true;
    if (checked.value == false) {

        nomDepart.value = [
            { departamento: 'Nariño' },
            { departamento: 'Cauca' },

        ];

        console.log(nomDepart.value);


    } else {


        const uniqueValues = new Set();

        props.resultados.forEach((element, index) => {
            // Verifica si el valor del departamento no está en el conjunto de valores únicos
            if (!uniqueValues.has(element.departamento)) {
                // Agrega el valor del departamento al conjunto de valores únicos
                uniqueValues.add(element.departamento);

                // Agrega el valor del departamento al array nomDepart.value
                nomDepart.value.push({
                    id: index,
                    departamento: element.departamento
                });
            }
        });

        console.log(nomDepart.value);

    }

});


watch(deparatamentoSelect, (val) => {



});


const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>
