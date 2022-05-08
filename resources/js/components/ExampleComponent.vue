<template>
	<v-container>
		<v-row align="center"  justify="center">
			<v-col md="6">
				<v-data-table
					:headers="headers"
					:items="list"
					class="elevation-1">

				<template v-slot:item.url="{ item }">
					<v-img
						lazy-src="https://picsum.photos/id/11/10/6"
						max-height="50"
						max-width="100"
						:src="item.url"
					></v-img>
				</template>
				</v-data-table>	
			</v-col>
		</v-row>
		<v-row align="center"  justify="center">
			
		</v-row>
    </v-container>
</template>

<script>
	import appSettings from '../settings/appSettings';

    export default {
		data() {
			return {
				headers : [
					{ text: 'URL', value: 'url' },
					{ text: 'Title', value: 'title' },
					{ text: 'Artist Name', value: 'artist_name' },
					{ text: 'Duration', value: 'duration' },
				],
				list: []
        }
		},
        mounted() {
           
			this.getSongs();
        },
		methods: {
			getSongs(){
				axios.get(appSettings.api_url + 'songs').then(res => {
					let {data} = res.data;

					this.list = data;
				})
			}
		}
    }
</script>
