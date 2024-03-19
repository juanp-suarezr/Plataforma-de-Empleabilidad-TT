<template>

    <Head title="Register" />

    <GuestLayout :isRegister=true>
        <Link href="/" class="flex items-center justify-center">
        <ApplicationLogo class="w-2/6 fill-current text-gray-500" />
        </Link>

        <form @submit.prevent="submit">
            <div class="card flex justify-center mx-6 z-10 gap-4 mt-4">
                <div class="card flex justify-content-center">
                    <SelectButton v-model="tipo_user" :options="options_user" aria-labelledby="basic" />
                </div>
                
            </div>

            <!-- REGISTER CAMPISTA -->
            <div v-if="tipo_user == 'campista'" class="flex">

                <!-- validado -->
                <div v-if="isValidate" class="w-full sm:grid grid-cols-2 gap-4 mt-6">

                    <!-- nombre -->
                    <div class="mb-2">
                        <InputLabel for="name" value="Nombre" class="text-gray-800" />
                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                            autocomplete="name" />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <!-- identificacion -->
                    <div class="mb-2">
                        <InputLabel for="identificacion" value="Identificación" class="text-gray-800" />
                        <TextInput id="identificacion" type="text" class="mt-1 block w-full"
                            v-model="form.identificacion" required autocomplete="identificacion" />
                        <InputError class="mt-2" :message="form.errors.identificacion" />
                    </div>
                    <!-- telefono -->
                    <div class="mb-2">
                        <InputLabel for="telefono" value="Telefono" class="text-gray-800" />
                        <TextInput id="telefono" type="tel" class="mt-1 block w-full" v-model="form.telefono" required
                            autocomplete="telefono" />
                        <InputError class="mt-2" :message="form.errors.telefono" />
                    </div>
                    <!-- departamento -->
                    <div class="mb-2">
                        <InputLabel for="departamento" value="Departamento" class="text-gray-800" />
                        <select id="departamento" name="departamento" v-model="deparatamentoSelect"
                            class="block w-full px-4 py-2 mt-1 text-base text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500">

                            <option class="text-black" v-for="dep in nomDepart" :key="dep.id" :value="dep.departamento">
                                {{ dep.departamento }}
                            </option>
                        </select>
                    </div>
                    <!-- municipio -->
                    <div class="mb-2">
                        <InputLabel for="ciudad" value="Municipio" class="text-gray-800" />
                        <select id="ciudad" name="ciudad" v-model="form.ciudad" :disabled="deparatamentoSelect == ''"
                            class="block w-full px-4 py-2 mt-1 text-base text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500">

                            <option class="text-black" v-for="mun in nomMuni" :key="mun.id" :value="mun.municipio">
                                {{ mun.municipio }}
                            </option>
                        </select>
                    </div>
                    <!-- email -->
                    <div class="mb-2">
                        <InputLabel for="email" value="Email" class="text-gray-800" />
                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                            autofocus autocomplete="username" />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mb-2">
                        <InputLabel for="password" value="Password" class="text-gray-800" />
                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                            required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="mb-2">
                        <InputLabel for="password_confirmation" value="Confirm Password" class="text-gray-800" />
                        <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                            v-model="form.password_confirmation" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>

                    <!-- input oculto para asignar roles -->
                    <input type='hidden' name='rol' v-model="checked" />


                </div>

                <!-- VALIDACION -->
                <div v-else class="m-auto">
                    <div class="mt-5 flex items-center justify-center">
                        <p class="text-gray-800 text-center text-xl sm:text-xl">Validar registro ingresando su numero de
                            Identificación</p>
                    </div>
                    <div class="gap-4 mt-4">

                        <!-- identificacion -->
                        <div class="mb-2">

                            <TextInput id="identificacion" type="text" class="mt-1 block w-full"
                                v-model="form.identificacion" required autocomplete="identificacion" />
                            <InputError class="mt-2" :message="form.errors.identificacion" />
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col items-center">
                        <PrimaryButton class="w-2/6 justify-center" @click="isValidate = true">
                            Validar
                        </PrimaryButton>
                    </div>

                </div>

            </div>
            <!-- EMPRESA -->
            <div v-else class="sm:grid grid-cols-2 gap-4 mt-6">

                <!-- nombre -->
                <div class="mb-2">
                    <InputLabel for="name" value="Nombre" class="text-white" />
                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                        autocomplete="name" />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <!-- identificacion -->
                <div class="mb-2">
                    <InputLabel for="identificacion" value="NIT" class="text-white" />
                    <TextInput id="identificacion" type="text" class="mt-1 block w-full" v-model="form.identificacion"
                        required autocomplete="identificacion" />
                    <InputError class="mt-2" :message="form.errors.identificacion" />
                </div>
                <!-- telefono -->
                <div class="mb-2">
                    <InputLabel for="telefono" value="Telefono" class="text-white" />
                    <TextInput id="telefono" type="tel" class="mt-1 block w-full" v-model="form.telefono" required
                        autocomplete="telefono" />
                    <InputError class="mt-2" :message="form.errors.telefono" />
                </div>
                <!-- departamento -->
                <div class="mb-2">
                    <InputLabel for="departamento" value="Departamento" class="text-white" />
                    <select id="departamento" name="departamento" v-model="deparatamentoSelect"
                        class="block w-full px-4 py-2 mt-1 text-base text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500">

                        <option class="text-black" v-for="dep in nomDepart" :key="dep.id" :value="dep.departamento">
                            {{ dep.departamento }}
                        </option>
                    </select>
                </div>
                <!-- municipio -->
                <div class="mb-2">
                    <InputLabel for="ciudad" value="Municipio" class="text-white" />
                    <select id="ciudad" name="ciudad" v-model="form.ciudad" :disabled="deparatamentoSelect == ''"
                        class="block w-full px-4 py-2 mt-1 text-base text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500">

                        <option class="text-black" v-for="mun in nomMuni" :key="mun.id" :value="mun.municipio">
                            {{ mun.municipio }}
                        </option>
                    </select>
                </div>
                <!-- email -->
                <div class="mb-2">
                    <InputLabel for="email" value="Email" class="text-white" />
                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
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

                <!-- input oculto para asignar roles -->
                <input type='hidden' name='rol' v-model="checked" />


            </div>

            <div class="mt-4 flex flex-col items-center">
                <PrimaryButton v-if="isValidate || tipo_user == 'empresa'" class="w-2/6 justify-center"
                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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
import SelectButton from 'primevue/selectbutton';


const form = useForm({
    name: '',
    estado: '',
    identificacion: '',
    telefono: '',
    telefono: '',
    region: '',
    ciudad: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
    rol: '',
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
const tipo_user = ref('campista');
const options_user = ref(['campista', 'empresa']);
//select departamentos
const deparatamentoSelect = ref("");
//array con departamentos
const nomDepart = ref([{ departamento: 'Nariño' },
{ departamento: 'Cauca' },]);

//array con municipios+
const nomMuni = ref([]);

//validado
const isValidate = ref(false);


//Cambiar vista formulario
watch(isValidate, (value) => {

    console.log(value);

});

//Cambiar form
watch(tipo_user, (value) => {

    nomDepart.value = [];
    let dep1 = true;
    let dep2 = true;
    if (tipo_user.value == 'campista') {

        nomDepart.value = [
            { departamento: 'Cauca' },
            { departamento: 'Nariño' },

        ];




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

                nomDepart.value.sort((a, b) => (a.departamento > b.departamento) ? 1 : -1);


            }
        });



    }

});


watch(deparatamentoSelect, (val) => {



    nomMuni.value = [];
    props.resultados.filter((item, index) => {
        if (item.departamento == val) {
            nomMuni.value.push(
                {
                    id: index,
                    municipio: item.municipio,
                });
        }
        return nomMuni.value.sort((a, b) => (a.municipio > b.municipio) ? 1 : -1);;
    });

    console.log(nomMuni.value);




});


const submit = () => {

    form.region = deparatamentoSelect.value;
    form.rol = checked.value;

    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>
