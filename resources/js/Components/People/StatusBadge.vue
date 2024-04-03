<script setup>
defineProps(['status'])

const Status = {
    PENDING: {
        color: 'bg-warning',
        text: 'Pendiente',
    },
    APPROVED: {
        color: 'bg-success text-white',
        text: 'Aprobado',
    },
    REJECTED: {
        color: 'bg-error text-white',
        text: 'Rechazado',
    }
}
</script>

<template>
    <span
        class="badge border-none"
        :class="Status[status].color"
    >
        {{ Status[status].text }}
    </span>
</template>
