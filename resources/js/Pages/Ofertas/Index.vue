<template>

    <Head title="Ofertas" />

    <AuthenticatedLayout>
        <template #header>
            Ofertas
        </template>


        <div class="lg:w-1/2 md:w-2/3 overflow-x-scroll md:overflow-x-auto">
            <div class="text-right p-4">
                <PrimaryLink :href="route('ofertas.create')">
                    Agregar
                </PrimaryLink>
            </div>
        </div>



        <div class="flex flex-col overflow-x-auto">
            <div class="inline-block rounded-lg shadow">
                <div class="inline-block min-w-full py-2">
                    <div class="overflow-x-auto">
                        <table class="min-w-full whitespace-no-wrap ">
                            <thead>
                                <tr
                                    class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    <th
                                        class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        titulo
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        horarios
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        categoria
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        tipo trabajo
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Salario
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users.data" :key="user.id" class="text-gray-700">
                                    
                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ user.titulo }}</p>
                                    </td>
                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ user.horarios }}</p>
                                    </td>
                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ user.categoria }}</p>
                                    </td>
                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ user.modalidad_trabajo }}</p>
                                    </td>
                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ formatNumber(user.salario) }}</p>
                                    </td>
                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                        <SecondaryButton :href="route('users.edit', user.id)">
                                            Editar
                                        </SecondaryButton>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">
            <pagination :links="users.links" />
        </div>







    </AuthenticatedLayout>
</template>

<script setup>

// import Pagination from '@/Components/Pagination.vue'
import { ref } from "vue";
import { watch } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryLink from '@/Components/PrimaryLink.vue';
import Pagination from '@/Components/Pagination.vue'
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Avatar from 'primevue/avatar';

const props = defineProps({
    users: {
        type: Object,
        default: () => ({}),
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
});

// pass filters in search
let search = ref(props.filters.search);
let estado_users = ref(props.filters.estado_users ?? "");
const handleEnterKey = () => {
    router.get(
        "/users",
        { search: search.value, estado_users: estado_users.value },
        {
            preserveState: true,
            replace: true,
        }
    );
};
const getInitials = function (name) {
    let parts = name.split(' ');
    let initials = '';
    let count = 0;

    for (var i = 0; i < parts.length && count < 2; i++) {
        if (parts[i].length > 0 && parts[i] !== '') {
            initials += parts[i][0];
            count++;
        }
    }
    return initials;
};
watch(search, (value) => {
    console.log("Valor de búsqueda actualizado:", value)
});

const formatNumber = value => {
    // Utilizar el filtro toLocaleString con el formato colombiano
    return value.toLocaleString('es-CO', {
        style: 'currency',
        currency: 'COP'
    });
}

// const swal = inject('$swal');

// // Modal de eliminacion
// const confirmingDeletion = ref(false);
// const role_id = ref();
// const form = useForm({
//     password: '',
// });

// const closeModal = () => {
//     confirmingDeletion.value = false;
//     form.reset();
// };

// const confirmUserDeletion = (id) => {
//     confirmingDeletion.value = true;
//     role_id.value = id;
// };
// const deleteRol = () => {
//     form.delete(route('roles.destroy', role_id.value), {
//         preserveScroll: true,
//         onSuccess: () => {
//             closeModal();
//             swal({
//                 title: "Registro Eliminado",
//                 text: "El rol se ha eliminado exitosamente",
//                 icon: "success"
//             })
//         },
//         onError: () => passwordInput.value.focus(),
//         onFinish: () => form.reset(),
//     });
// };

// //paginacion tutores
// const itemsPerPage = ref(8);
// const currentPage = ref(0);

// const totalPages = computed(() => Math.ceil(props.roles.length / itemsPerPage.value));



// const previousPage = () => {
//     if (currentPage.value > 0) {
//         currentPage.value--;
//     }
// };

// const nextPage = () => {
//     if (currentPage.value < totalPages.value - 1) {
//         currentPage.value++;
//     }
// };
// //FIN Paginacion

// watch(itemsPerPage, () => {
//     currentPage.value = 0;
// });

// //SEARCH
// const searchTerm = ref('');

// //Paginacion y filtro
// const slicedRoles = computed(() => {
//     const start = currentPage.value * itemsPerPage.value;
//     const end = start + itemsPerPage.value;
//     const filteredUsers = props.roles.filter(roles =>
//         roles.name.toLowerCase().includes(searchTerm.value.toLowerCase())
//     );
//     return filteredUsers.slice(start, end);
// });

</script>
