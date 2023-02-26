<script setup>
	import HeaderLogo from '@/Components/Logo/HeaderLogo.vue';
	import HamburgerMenu from '@/Components/HamburgerMenu.vue';
	import MobileHeaderLink from '@/Components/Links/MobileHeaderLink.vue';
	import Footer from '@/Components/Footer.vue'
</script>
<template>
	<header>
		<div  class="bg-yellow-400 p-4 flex items-center justify-between">
			<HeaderLogo />
			<HamburgerMenu />
		</div>
		<nav class="p-4">
			<ul>
				<MobileHeaderLink href="/" name="Home"/>
			</ul>
		</nav>
	</header>
		<slot />
	<Footer />
</template>