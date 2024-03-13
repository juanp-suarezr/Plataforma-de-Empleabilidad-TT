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
       
        

        
        <Card style="width: 25rem; overflow: hidden">
            <template #header>
                <img alt="user header" src="/images/usercard.png" />
            </template>
            <template #title>Advanced Card</template>
            <template #subtitle>Card subtitle</template>
            <template #content>
                <p class="m-0">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore sed consequuntur error repudiandae numquam deserunt quisquam repellat libero asperiores earum nam nobis, culpa ratione quam perferendis esse, cupiditate neque
                    quas!
                </p>
            </template>
            <template #footer>
                <div class="flex gap-3 mt-1">
                    <Button label="Cancel" severity="secondary" outlined class="w-full" />
                    <Button label="Save" class="w-full" />
                </div>
            </template>
        </Card>

        

      


    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
// import Pagination from '@/Components/Pagination.vue'
import PrimaryLink from '@/Components/PrimaryLink.vue';
// import Modal from '@/Components/Modal.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import { ref, computed, watch, inject, onMounted } from 'vue';
// import SecondaryButton from "@/Components/SecondaryButton.vue";
// import DangerButton from '@/Components/DangerButton.vue';
// import InputError from '@/Components/InputError.vue';
// import InputLabel from '@/Components/InputLabel.vue';
// import TextInput from '@/Components/TextInput.vue';

import Card from 'primevue/card';

// const props = defineProps({
//     roles: Object
// })
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
