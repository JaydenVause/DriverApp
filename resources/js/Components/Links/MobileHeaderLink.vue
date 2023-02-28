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
	<li class="bg-gray-900 p-3 text-white hover:cursor-pointer hover:bg-white hover:text-black"><Link :href="href" :method="method" as="type">{{name}}</Link></li>
</template>