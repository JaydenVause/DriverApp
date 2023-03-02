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
		<div  class="yellow-gradient header_nav">
			<div class=" p-4 flex items-center justify-between max-w-[1200px] m-auto h-[70px]">
				<HeaderLogo />
				<HamburgerMenu class="md:hidden" @click="toggleMobileNav" />
				<nav class="hidden md:flex">
					<ul class="flex gap-3">
						<li>
							<DesktopHeaderLink href="/" name="Home"/>
						</li>
						
						<li v-if="$page.props.auth.user">
							<DesktopHeaderLink href="/profile" name="Profile"/>
						</li>

						<li v-if="$page.props.auth.user">
							<DesktopHeaderLink href="/instructor/update-profile" name="Update your instructor profile" />
						</li>

						<li v-if="$page.props.auth.user"><DesktopHeaderLink href="/admin" name="Access admin dashboard" /></li>
						<li v-if="$page.props.auth.user"><DesktopHeaderLink href="/register/driving-instructor" name="Register as driving instructor" /></li>

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
					<MobileHeaderLink href="/profile" name="Profile"/>
					<MobileHeaderLink href="/logout" method="post" name="Logout"/>
					<MobileHeaderLink href="/admin" name="Access admin dashboard" />
					<MobileHeaderLink href="/register/driving-instructor" name="Register as driving instructor" />
					<MobileHeaderLink href="/instructor/update-profile" name="Update your instructor profile" />
				</div>
				<div v-else>
					<li><MobileHeaderLink href="/login" name="Login"/></li>
					<li><MobileHeaderLink href="/register" name="Register"/></li>
				</div>
			</ul>
		</nav>
	</header>
</template>
<style>
	.yellow-gradient{
		 background: rgb(255,207,0);
		background: linear-gradient(120deg, rgba(255,207,0,1) 0%, rgba(255,246,9,1) 100%); 
	}

	
</style>