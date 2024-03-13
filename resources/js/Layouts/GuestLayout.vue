<template>
    <div class="intro-container">
        <div class="flex h-screen items-center justify-center px-6">
            <div class="w-full rounded-md bg-gray-900 p-6 shadow-md" :class="isRegister ? 'max-w-2xl' : 'max-w-sm'">
                <slot />
            </div>
        </div>
    </div>
</template>

<script setup>
import "../script.js";
import "../../css/style.css";

defineProps(['isRegister']);
</script>
