<template>
  <div class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <slot />
      </div>
    </div>
  </div>
</template>

<style scoped>
.modal-content{
  border-radius: 1.2rem
}
</style>