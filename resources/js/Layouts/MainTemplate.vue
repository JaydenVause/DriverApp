<script setup>


	import Header from '@/Components/Header.vue';
	import Footer from '@/Components/Footer.vue';


	function close_message(page){
		page.props.message.success = null
	}

</script>
<template>
	<Header />
		<div class="pt-[70px] min-h-[80vh] bg-yellow-400">
			<slot name="super" />
			<div  class=" m-auto bg-yellow-400 " >
				<div class="w-full flex flex-col items-center">
					<div v-if="$page.props.message.success" class="alert bg-green-400 text-green-900 p-4 max-w-[1175px] mx-3 my-3 rounded w-full">
				        {{ $page.props.message.success }}
				        <button class="float-right" @click="close_message($page)">x</button>
				    </div>
				</div>
				<slot/>
			</div>
		</div>
	<Footer />
</template>
<style>
	@font-face{
		font-family: 'Roboto';
		src: url('/fonts/roboto/Roboto-Regular.ttf');
	}


	.header_nav{
		z-index: 10;
		position: fixed;
		width: 100%;
	}
	.hidden-mobile-nav{
		position: absolute;
		background-color: white;
		width: 100%;
		transition: all 0.3s ease-in-out;
  		transform: translateY(-300%);
  		z-index: 2
	}

	.show-mobile-nav{

		position: fixed;
		width: 100%;
		transition: all 0.3s ease-in-out;
		transform: translateY(70px);
		z-index: 2;
		background-color: white;
	}

	h1, h2, h3, h4, h5, h6, a, p{
		font-family: 'Roboto'
	}
</style>