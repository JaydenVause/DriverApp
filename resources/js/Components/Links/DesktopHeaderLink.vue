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
	<li><Link class="text-lg hover:ease-in duration-100 hover:underline hover:text-white" :href="href" :method="method" type="type">{{name}}</Link></li>
</template>