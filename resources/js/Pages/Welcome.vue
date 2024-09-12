<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { reactive, onMounted, onBeforeUnmount } from 'vue';

import GusestLink from '@/Components/Guest/Link.vue'


const animate_s = reactive({
  inMove: false,
  inMoveDelay: 400,
  activeSection: 0,
  offsets: [],
  touchStartY: 0,
})

function calculateSectionOffsets() {
  let sections = document.getElementsByTagName('section');
  let length = sections.length;

  for (let i = 0; i < length; i++) {
    let sectionOffset = sections[i].offsetTop;
    animate_s.offsets.push(sectionOffset);
  }
}


function scrollToSection(id, force = false) {
  if (animate_s.inMove && !force) return false;

  animate_s.activeSection = id;
  animate_s.inMove = true;

  // get section and scroll into view if it exists
  let section = document.getElementsByTagName('section')[id];
  if (section) {
    document.getElementsByTagName('section')[id].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
  }

  setTimeout(() => {
    animate_s.inMove = false;
  }, animate_s.inMoveDelay);

}

function moveDown() {
  animate_s.inMove = true;
  animate_s.activeSection--;

  if (animate_s.activeSection < 0) animate_s.activeSection = animate_s.offsets.length - 1;

  scrollToSection(animate_s.activeSection, true);
}

function moveUp() {
  animate_s.inMove = true;
  animate_s.activeSection++;

  if (animate_s.activeSection > animate_s.offsets.length - 1) animate_s.activeSection = 0;

  scrollToSection(animate_s.activeSection, true);
}
function handleMouseWheel(e) {


  if (e.wheelDelta < 30 && !animate_s.inMove) {
    moveUp();
  } else if (e.wheelDelta > 30 && !animate_s.inMove) {
    moveDown();
  }

  e.preventDefault();
  return false;
}


onMounted(() => {
  //  console.log(`The initial count is ${count.value}.`)
  calculateSectionOffsets();
  //window.addEventListener('DOMMouseScroll', handleMouseWheelDOM);  // Mozilla Firefox
  window.addEventListener('mousewheel', handleMouseWheel, { passive: false }); // Other browsers

  //window.addEventListener('touchstart', touchStart, { passive: false }); // mobile devices
  //window.addEventListener('touchmove', touchMove, { passive: false }); // mobile devices
})



onBeforeUnmount(() => {
  
 // window.removeEventListener('DOMMouseScroll', handleMouseWheelDOM); // Mozilla Firefox
  window.removeEventListener('mousewheel', handleMouseWheel, { passive: false });  // Other browsers

  //window.removeEventListener('touchstart', touchStart); // mobile devices
 // window.removeEventListener('touchmove', touchMove); // mobile devices
  
})
</script>
<template>

  <Head title="Добро пожаловать"></Head>




  <div class="sections-menu">
    <span class="menu-point" v-bind:class="{ active: animate_s.activeSection == index }"
      v-on:click="scrollToSection(index)" v-for="(offset, index) in animate_s.offsets" v-bind:key="index">
    </span>
  </div>

  <div class="min-h-screen w-full">


    <section class="fullpage w-full h-screen">


      <div class="">



        <div v-if="$page.props.auth.user">
          <Link :href="route('user.dashboard')">
          Главная
          </Link>

        </div>

        <div v-else class="flex flex-col gap-2 p-4">


          <div class="flex items-center justify-center mb-6">
            <img class="h-16 w-auto" src="/images/logo.png" alt="">
          </div>

          <div class="grid grid-cols-1 gap-4">
            <GusestLink :href="route('login')" :icon="['fas', 'right-to-bracket']">Войти в систему</GusestLink>
            <GusestLink :href="route('register')" :icon="['fas', 'user-plus']">Создать аккаунт</GusestLink>
            <GusestLink :href="route('register')" :icon="['far', 'calendar-days']">Ближайшие курсы</GusestLink>
            <GusestLink :href="route('register')" :icon="['fas', 'chart-simple']">Статистика</GusestLink>
            <GusestLink :href="route('register')" :icon="['fas', 'handshake-angle']">Техническая поддержка</GusestLink>

          </div>


        </div>
      </div>
      <img src="/images/scroll-bar.png" class="icon-scroll h-16 w-auto fixed" alt="">
    </section>

    <section class="fullpage w-full h-screen bg-[#283655]">
      <div class="grid gap-10 grid-cols-4 w-full p-20">
        <div class="bg-white  h-[200px] rounded flex justify-center items-center">
          <h1>Данные о курсе (в разработке)</h1>
        </div>
        <div class="bg-white  h-[200px] rounded flex justify-center items-center">
          <h1>Данные о курсе (в разработке)</h1>
        </div>
        <div class="bg-white  h-[200px] rounded flex justify-center items-center">
          <h1>Данные о курсе (в разработке)</h1>
        </div>
        <div class="bg-white  h-[200px] rounded flex justify-center items-center">
          <h1>Данные о курсе (в разработке)</h1>
        </div>

      </div>



    </section>
    <section class="fullpage w-full h-screen">
      <h1>Реализовано за год</h1>
    </section>
    <section class="fullpage w-full h-screen">
      <p>Техническая поддержка</p>
    </section>

  </div>

</template>

<!-- scoped если нужно только для текущего элемента -->
<style lang="sass">


body
  background: url('/images/viro_v2.png')
  background-attachment: fixed
  background-position: center
   

.fullpage 
  height: 100vh
  width: 100%
  display: flex
  justify-content: center
  align-items: center
  flex-direction: column

.sections-menu 
  position: fixed
  right: 1rem
  top: 50%
  transform: translateY(-50%)


.sections-menu .menu-point 
  width: 10px
  height: 10px
  background-color: #FFF
  display: block
  margin: 1rem 0
  opacity: .6
  transition: .4s ease-in-out all
  cursor: pointer

.sections-menu .menu-point.active 
  opacity: 1
  transform: scale(1.5)

.sections-menu .menu-point:hover 
  opacity: 1
  transform: scale(1.2)

.icon-scroll
  animation: toggle 1s linear infinite
  right: 20px

@keyframes toggle
  0%, 100% 
    bottom: 15px
  
  50% 
    bottom: 20px
  

</style>