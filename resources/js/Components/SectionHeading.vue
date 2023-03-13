<template>
  <div class="text-center">
    <h2 class="text-4xl text-black font-bold">
      <slot name="heading" />
    </h2>
    <p class="text-red-500 text-lg font-semibold">
      <slot name="subheading" />
    </p>
  </div>
</template>