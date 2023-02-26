<script>
	import { Link } from '@inertiajs/vue3';

	export default{

		props: ['href', 'name'],

		components: {
			Link
		},
	}
</script>
<template>
	<li><Link :href="href">{{name}}</Link></li>
</template>