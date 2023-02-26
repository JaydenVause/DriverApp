<script setup>
	import HeaderLogo from '@/Components/Logo/HeaderLogo.vue';
	import HamburgerMenu from '@/Components/HamburgerMenu.vue';
	import MobileHeaderLink from '@/Components/Links/MobileHeaderLink.vue';
	import DesktopHeaderLink from '@/Components/Links/DesktopHeaderLink.vue';

	import Footer from '@/Components/Footer.vue';
	import { ref } from 'vue';

	let mobileNavOpen = ref(false);

	let toggleMobileNav = function(){
		mobileNavOpen.value = !mobileNavOpen.value
	};
</script>
<template>
	<header>
		<div  class="bg-yellow-400 header_nav">
			<div class=" p-4 flex items-center justify-between max-w-[1200px] m-auto h-[70px]">
				<HeaderLogo />
				<HamburgerMenu class="md:hidden" @click="toggleMobileNav" />
				<nav class="hidden md:flex">
					<ul class="flex gap-3">
						<li>
							<DesktopHeaderLink href="/" name="Home"/>
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
		<nav :class="mobileNavOpen ? 'show-mobile-nav sm:hidden' : 'hidden-mobile-nav'">
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
		position: fixed;
		width: 100%;
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

	h1, h2, h3, h4, h5, h6, a, p{
		font-family: 'Roboto'
	}
</style>