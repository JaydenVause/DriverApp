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
	<li><Link :href="href" :method="method" type="type">{{name}}</Link></li>
</template>