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
	<Link class="text-lg text-white hover:underline  hover:cursor-pointer" :href="href" :method="method" as="type">{{name}}</Link>
</template>