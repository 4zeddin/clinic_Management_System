<template>
  <div class="page-section">
    <div class="container">
      <h1 class="text-center">Make an Appointment</h1>
      
      <form @submit.prevent="submitForm" class="main-form">
        <div class="row mt-5">
          <div class="col-12 col-sm-6 py-2">
            <input 
              v-model="formData.name" 
              :disabled="isAuthenticated" 
              type="text" 
              class="form-control" 
              placeholder="Full name" 
              style="background-color: #ffffff; color: #000000;"
            />
          </div>
          
          <div class="col-12 col-sm-6 py-2">
            <input 
              v-model="formData.email" 
              :disabled="isAuthenticated" 
              type="email" 
              class="form-control" 
              placeholder="Email address.." 
              style="background-color: #ffffff; color: #000000;"
            />
          </div>
          
          <div class="col-12 col-sm-6 py-2">
            <input 
              v-model="formData.date" 
              id="datepicker" 
              type="text" 
              placeholder="yyyy-mm-dd" 
              class="form-control" 
              style="background-color: #ffffff; color: #000000;"
            />
          </div>
          
          <div class="col-12 col-sm-6 py-2">
            <select v-model="formData.doctor" class="custom-select">
              <option disabled value="">--- Select Doctor ---</option>
              <option v-for="doctor in doctors" :key="doctor.name" :value="doctor.name">
                Dr. {{ doctor.name }} - Speciality: {{ doctor.speciality }} - 300dh/h
              </option>
            </select>
          </div>
          
          <div class="col-12 py-2">
            <input 
              v-model="formData.phone" 
              :disabled="isAuthenticated" 
              type="text" 
              class="form-control" 
              placeholder="Phone number" 
              style="background-color: #ffffff; color: #000000;"
            />
          </div>
          
          <div class="col-12 py-2">
            <textarea v-model="formData.message" class="form-control" rows="6" placeholder="Enter message.."></textarea>
          </div>
        </div>
        
        <button v-if="isAuthenticated" type="submit" class="btn btn-primary mt-3">
          Submit Request
        </button>
        
        <button v-else type="button" class="alert alert-warning mt-3" disabled>
          <i class="bi bi-exclamation-triangle"></i> Login Required To Make Appointment
        </button>
      </form>
    </div>
  </div>
</template>

<script>

export default {
  props: {
    doctors: Array,  
    pickedDates: Array, 
    isAuthenticated: Boolean,  
    authUser: Object  
  },
  data() {
    return {
      formData: {
        name: this.isAuthenticated ? this.authUser.name : "",
        email: this.isAuthenticated ? this.authUser.email : "",
        phone: this.isAuthenticated ? this.authUser.phone : "",
        date: "",
        doctor: "",
        message: ""
      }
    };
  },
  mounted() {
    this.initializeFlatpickr();
  },
  methods: {
    initializeFlatpickr() {
      flatpickr("#datepicker", {
        minDate: "today",
        disable: this.pickedDates.map(date => new Date(date)),
        dateFormat: "Y-m-d"
      });
    },
    submitForm() {
      console.log("Form submitted", this.formData);
    }
  }
};
</script>


