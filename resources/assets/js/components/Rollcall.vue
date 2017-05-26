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
          <div>{{ attendance.name }}<a href="#!" class="secondary-content" @click.stop="deleteAttendance(attendance)"><i class="material-icons">delete</i></a></div></li>
       </ul>
       <br/>
          <a :href="rollCallPath"  v-if="attendances.length > 0" class="btn waves-effect waves-light"> Finish </a>
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
                rollCall: "",
                rollCallPath: "/rollcall/" + moment().format('YYYY-MM-DD') + "/attendances",
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
                     vm.attendances.push(response.data)
                     vm.rollCall = response.data.rollCall;
   					})
                  this.name = ""
                  $('.input-field .input').focus()
   				},
               deleteAttendance: function(attendance){
                  let url = "/api/attendances/" + attendance.id + "/absent"
                  let vm = this
                  axios.put(url, {date: this.date })
                  .then(function(response){
                    vm.attendances =  vm.attendances.filter(function(att){
                        return att.id !== attendance.id
                     })
                     console.log(vm.attendances)
                     // console.log(vm.attendances)
                  })
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
