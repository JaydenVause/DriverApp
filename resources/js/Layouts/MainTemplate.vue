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
		<slot />
	<Footer />
</template>