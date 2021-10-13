<template>
  <!--Footer-->
  <footer class="py-4 bg-light mt-auto">
    <div class="container-fluid">
      <div class="d-flex align-items-center justify-content-between small">
        <div class="text-muted">Copyright &copy; Imanzi Creations 2021</div>
        <div>
          <a href="#">Privacy Policy</a>
          &middot;
          <a href="#">Terms &amp; Conditions</a>
        </div>
      </div>
    </div>
    <a
      href="https://wa.me/250784680568"
      id="myBtn"
      target="_blank"
      data-toggle="tooltip"
      data-placement="top"
      title="Whatsapp us!"
      ><img src="/assets/images/Whatsapp-Icon.png" width="45" height="45"
    /></a>
  </footer>
  <!--Footer-END-->
</template>

<script>
export default {
  name: "footer",
};
</script>

<style scoped>
#myBtn {
  display: block;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: transparent;
  color: white;
  cursor: pointer;
  padding: 0px;
  border-radius: 50px;
}
</style>
