<script setup>
	import HeaderLogo from '@/Components/Logo/HeaderLogo.vue';
	import HamburgerMenu from '@/Components/HamburgerMenu.vue';
	import MobileHeaderLink from '@/Components/Links/MobileHeaderLink.vue';
	import DesktopHeaderLink from '@/Components/Links/DesktopHeaderLink.vue';
	import { ref } from 'vue';

	// mobile navigation interactive
	let mobileNavOpen = ref(false);
	let toggleMobileNav = function(){
		mobileNavOpen.value = !mobileNavOpen.value
	};
</script>
<template>
	<header>
  <div class="bg-[rgb(32,32,32)] text-white header_nav">
    <div class="max-w-[1200px] m-auto h-[70px] flex items-center justify-between p-4">
      <HeaderLogo />
      <button class="md:hidden" @click="toggleMobileNav">
        <svg v-if="!mobileNavOpen" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg v-else class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
      <nav class="hidden md:flex">
        <ul class="flex gap-3">
          <li>
            <DesktopHeaderLink href="/" name="Home"/>
          </li>
          <li v-if="$page.props.auth.user">
            <DesktopHeaderLink href="/profile" name="Profile"/>
          </li>
          <li v-if="$page.props.auth.user">
            <DesktopHeaderLink href="/logout" method="post" name="Logout"/>
          </li>
          <li v-if="!$page.props.auth.user">
            <DesktopHeaderLink href="/login" name="Login"/>
          </li>
          <li v-if="!$page.props.auth.user">
            <DesktopHeaderLink href="/register" name="Register"/>
          </li>
        </ul>
      </nav>
    </div>
    
  </div>
  <!--mobile_navigation_menu-->
  <nav :class="mobileNavOpen ? 'show-mobile-nav md:hidden' : 'hidden-mobile-nav'">
    <ul>
      <li>
        <MobileHeaderLink href="/" name="Home"/>
      </li>
      <div v-if="$page.props.auth.user">
        <MobileHeaderLink href="/profile" name="Profile"/>
        <MobileHeaderLink href="/logout" method="post" name="Logout"/>
        <MobileHeaderLink href="/admin" name="Access admin dashboard" />
        <MobileHeaderLink href="/register/driving-instructor" name="Register as driving instructor" />
        <MobileHeaderLink href="/instructor/update-profile" name="Update your instructor profile" />
      </div>
      <div v-else>
        <li>
          <MobileHeaderLink href="/login" name="Login"/>
        </li>
        <li>
          <MobileHeaderLink href="/register" name="Register"/>
        </li>
      </div>
    </ul>
  </nav>
  <div class=" fixed  top-[70px] w-full  right-0 m-auto hidden md:block bg- z-[1] bg-[rgb(32,32,32)]" v-if="$page.props.auth.user && $page.props.auth.user.admin">
    <div class="max-w-[1200px] text-white mx-auto">
       <ul class="flex gap-3 justify-end p-4 ">
        <li v-if="$page.props.auth.user && $page.props.auth.user.admin">
          <DesktopHeaderLink href="/admin" name="Access admin dashboard" />
        </li>
        <li v-if="$page.props.auth.user && $page.props.auth.user.admin">
          <DesktopHeaderLink href="/register/driving-instructor" name="Register as driving instructor" />
        </li>
        <li v-if="$page.props.auth.user && $page.props.auth.user.admin">
          <DesktopHeaderLink href="/instructor/update-profile" name="Update your instructor profile" />
        </li>
        <li v-if="$page.props.auth.user && $page.props.auth.user.admin">
          <DesktopHeaderLink href="/turn_off_admin" name="Disable Admin Mode" />
        </li>
        
      </ul>
    </div>   
  </div>
</header>


</template>
<style>
	.yellow-gradient{
		 background: rgb(255,207,0);
		background: linear-gradient(120deg, rgba(255,207,0,1) 0%, rgba(255,246,9,1) 100%); 
	}

	
</style>