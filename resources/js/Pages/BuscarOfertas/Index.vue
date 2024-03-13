<template>

    <Head title="Buscar Ofertas" />

    <AuthenticatedLayout>
        <template #header>
            Usuarios
        </template>

        <div class="inline-block min-w-full overflow-hidden mb-3 grid md:grid-cols-3 gap-4">

            <div class="...">
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <MagnifyingGlassIcon class="w-4 h-4 text-gray-500" />
                    </div>
                    <input type="search" @keydown.enter="handleEnterKey" v-model="search" id="default-search"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-0 focus:border-transparent"
                        placeholder="Busqueda de usuarios" required>

                </div>
            </div>

            <div class="text-right p-4">
                filtros

            </div>

            <div class="flex">
                <button type="submit" @click="handleEnterKey"
                    class="m-auto text-white bg-sky-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Buscar</button>
            </div>


        </div>
        <div class="flex flex-col overflow-x-auto">
            <div class="inline-block rounded-lg shadow">

                <DataView :value="props.ofertas" paginator :rows="5">

                    <template #list="slotProps">
                        <div class="grid">
                            <div v-for="(item, index) in slotProps.items" :key="index" class="col-12">
                                <div class="flex flex-col sm:flex-row sm:align-items-center p-4 gap-3"
                                    :class="{ 'border-top-1 surface-border': index !== 0 }">
                                    <div class="md:w-36 relative">
                                        <img class="block xl:block mx-auto border-round w-full"
                                            :src="item.logo ? '' : logo" :alt="item.nombre" />

                                    </div>
                                    <div
                                        class="flex flex-col md:flex-row justify-between md:align-items-center flex-1 gap-4 ms-2">
                                        <div class="flex flex-col md:flex-row justify-between align-items-start gap-2">
                                            <div>
                                                <div
                                                    class="py-2 px-4 rounded-md shadow-xl bg-amber-400 flex inline-flex">
                                                    <span class="md:font-base text-sm text-gray-900 m-auto">{{ item.categoria
                                                        }}</span>
                                                </div>

                                                <div class="md:text-xl text-base font-medium text-900 mt-2">
                                                    {{ item.titulo }}</div>
                                                <span class="font-medium md:text-lg text-sm">{{ item.descripcion
                                                    }}</span>
                                            </div>
                                            <div class="surface-100 p-1 rounded-xl">
                                                <div
                                                    class="surface-0 flex align-items-center gap-2 justify-center py-1 px-2 rounded-xl">
                                                    <span class="font-medium text-secondary text-sm">{{ item.horarios
                                                        }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:align-items-end justify-end gap-5">
                                            <span class="text-xl font-semibold text-900">{{ formatNumber(item.salario)
                                                }}</span>

                                            <div class="flex flex-row gap-2">
                                                

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </DataView>

            </div>
        </div>


    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from "vue";
import { watch } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryLink from '@/Components/PrimaryLink.vue';
import Pagination from '@/Components/Pagination.vue'
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Avatar from 'primevue/avatar';
import { MagnifyingGlassIcon } from "@heroicons/vue/24/solid";
import DataView from 'primevue/dataview';
import DataViewLayoutOptions from 'primevue/dataviewlayoutoptions';


const props = defineProps({
    ofertas: {
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
</script>
