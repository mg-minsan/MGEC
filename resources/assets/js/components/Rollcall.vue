   <template>
   <div>


 <div class="row">
      <div class="col s12">
         <label for="name">Date</label>
      <input type="text" class="datepicker" v-model="date"> 
      </div>

      </div>
       <div class="row">
         <div class="col s12">
           <form v-on:submit.prevent>
             <div class="input-field">
               <label for="name">Name</label>
               <input v-model="name" 
               @keydown="getSuggestion" 
               class="input" 
               type="text" 
               placeholder="Text input">
               <ul class="collection" >
                  <li class="collection-item" v-for="user in result" @mousedown="selected(user.name)"> {{  user.name }} </li>
               </ul>
            </div>
            <button class="waves-effect waves-light btn" v-on:click="present">  Present </button>
         </form>
      </div>

   </div>
   <br/>
   <div class="row">

      <div class="col s12">
         <ul class="collection" v-if="attendances.length > 0">
          <li class="collection-item" 
          v-for="attendance in attendances">
          <div>{{ attendance.name }}<a href="#!" class="secondary-content"><i class="material-icons">delete</i></a></div></li>
       </ul>

    </div>

</div>
</div>


</template>

   	<script>
      import moment from 'moment'
      import flatpickr from 'flatpickr'

         export default {

            data(){
              return {
                name: "",
                result: "",
                date: moment().format('YYYY-MM-DD'),
                rollcall: "",
                attendances: []
             }
          },
          props: ['trip'],
          methods:{
           present: function(){

             let url = "/api/attendances/" + this.name + "/present"
                  let vm = this
                  axios.put(url, {date: vm.date, trip: vm.trip})
   					.then(function(response){
                                          console.log(response.data)
                     vm.attendances.push(response.data)
   					})
                  this.name = ""
                  $('.input-field .input').focus()
   				},
  				selected: function(name){
                  this.result = ""
                  this.name = name
                  let url="/api/attendances/"
   					console.log(name)
   				},
   				getSuggestion: _.debounce(
   					function () {
   						this.loading = true;
   						var vm = this;
                     if(this.name == ""){
                        return 
                     }
   						let url = '/api/attendances/' + this.name + '/suggest'
   						axios.get(url)
   						.then(function (response) {
   							vm.result = _.differenceBy(response.data, vm.attendances, 'id' )
   						})
   						.catch(function (error) {
   							console.log(error);
   						})
   					}, 500),
   			},
            mounted(){
               $('.datepicker').flatpickr({
                  disableMobile: "true"
               })
               console.log(this.trip)
               $(document).ready(function() {
                 $('select').material_select();
              })


            }
   		}
   	</script>
      <style>
      .collection{
         margin-top: -1.5em;
      }
      .collection-item:hover{
         background-color: #7f7f7;
      } 

      </style>
