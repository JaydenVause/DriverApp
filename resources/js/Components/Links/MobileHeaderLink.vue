<script>
	import { Link } from '@inertiajs/vue3';

	export default{

		props: ['href', 'name', 'method', 'type'],

		components: {
			Link
		},
	}
</script>
<template>
	<li><Link class=" hover:cursor-pointer" :href="href" :method="method" as="type">{{name}}</Link></li>
</template>