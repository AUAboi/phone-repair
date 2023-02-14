<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import ChooseRepairTypeStep from './CreateForm/ChooseRepairTypeStep.vue'
const props = defineProps(["device", "repairs"])

const form = useForm({
  repair_type: props.device.device_repairs[0].repair_type
})
</script>

<template>

  <Head :title="`Book ${props.device.name} repair`" />
  {{ device.device_repairs }}

  <ChooseRepairTypeStep :form="form" :device-repairs="device.device_repairs" />
</template>