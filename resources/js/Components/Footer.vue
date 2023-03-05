<script setup>
	import FooterUlLink from '@/Components/Links/FooterUlLink.vue';
</script>
<template>
	<footer class="bg-[rgb(32,32,32)] p-4">
		<div class="max-w-[1200px] m-auto">
			<div>
				<ul v-if="$page.props.auth.user">
					<li v-if="!$page.props.auth.user.admin"><FooterUlLink href="/turn_on_admin" name="Enable Admin Mode" /></li>
					<li v-if="$page.props.auth.user.admin"><FooterUlLink href="/turn_off_admin" name="Disable Admin Mode" /></li>
					<li v-if="$page.props.auth.user.admin"><FooterUlLink href="/admin" name="Access admin dashboard" /></li>
					<li><FooterUlLink href="/register/driving-instructor" name="Register as driving instructor" /></li>
					<li><FooterUlLink href="/instructor/update-profile" name="Update your instructor profile" /></li>
					
				</ul>
			</div>
			<p class="text-white text-center">Page created by Jayden Vause 2023 &#169;</p>
		</div>
	</footer>
</template>