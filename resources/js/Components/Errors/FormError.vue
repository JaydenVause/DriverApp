<script>
	export default{
		props: ['conditions']
	}
</script>
<template>
	<p class="error" v-if="conditions">
        <template v-for="condition of conditions">
        	{{condition}}
        </template>
    </p>
</template>