<script setup>
	import FooterUlLink from '@/Components/Links/FooterUlLink.vue';
</script>
<template>
	<footer class="bg-gray-700 p-4">
		<div>
			<ul>
				<li><FooterUlLink href="/admin" name="Access admin dashboard" /></li>
				<li><FooterUlLink href="/register/driving-instructor" name="Register as driving instructor" /></li>
			</ul>
		</div>
		<p class="text-white text-center">Page created by Jayden Vause 2023 &#169;</p>
	</footer>
</template>