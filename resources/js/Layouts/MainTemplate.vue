<script setup>
	import HeaderLogo from '@/Components/Logo/HeaderLogo.vue';
	import HamburgerMenu from '@/Components/HamburgerMenu.vue';
	import MobileHeaderLink from '@/Components/Links/MobileHeaderLink.vue';
	import Footer from '@/Components/Footer.vue';
	import { ref } from 'vue';

	let mobileNavOpen = ref(false);

	let toggleMobileNav = function(){
		mobileNavOpen.value = !mobileNavOpen.value
	};
</script>
<template>
	<header>
		<div  class="bg-yellow-400 p-4 flex items-center justify-between header_nav">
			<HeaderLogo />
			<HamburgerMenu @click="toggleMobileNav" />
		</div>
		<nav :class="mobileNavOpen ? 'show-mobile-nav' : 'hidden-mobile-nav'">
			<ul>
				<li><MobileHeaderLink href="/" name="Home"/></li>
				<div v-if="$page.props.auth.user">
					<li><MobileHeaderLink href="/logout" method="post" name="Logout"/></li>
				</div>
				<div v-else>
					<li><MobileHeaderLink href="/login" name="Login"/></li>
					<li><MobileHeaderLink href="/register" name="Register"/></li>
				</div>
			</ul>
		</nav>
	</header>
		<div class="pt-[70px]">
			<slot />
		</div>
	<Footer />
</template>
<style>

	.header_nav{
		z-index: 10;
		position: absolute;
		width: 100%;
		height: 70px;
	}
	.hidden-mobile-nav{
		position: absolute;
		background-color: white;
		width: 100%;
		transition: all 0.3s ease-in-out;
  		transform: translateY(-300%);
  		z-index: 2
	}

	.show-mobile-nav{

		position: absolute;
		width: 100%;
		transition: all 0.3s ease-in-out;
		transform: translateY(70px);
		z-index: 2;
		background-color: white;
	}
</style>