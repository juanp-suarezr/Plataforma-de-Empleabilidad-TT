<template>
    <div class="intro-container">
        <div class="flex h-screen items-center justify-center px-6">
            <div class="w-full max-w-sm rounded-md bg-gray-900 p-6 shadow-md">
                <slot />
            </div>
        </div>
    </div>
</template>

<script setup>
import "../script.js";
import "../../css/style.css";
</script>
