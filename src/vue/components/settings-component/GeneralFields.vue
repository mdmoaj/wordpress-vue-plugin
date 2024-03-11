<template>
<div>

    <div class="customer_box shadow-lg pt-4 pb-5 ">
        <div class="api_token  w-100 ">
            <h5 class="mb-0">General Fields</h5>
            <p>Add fields that you want to get information about the customer</p>
        </div>
        <div class="customer_box_table mt-4">
            <table class="customer_table">
                <thead>
                    <th>
                        <div style="width:260px;"></div>
                    </th>
                    <th>
                        <div style="width:60px;"></div>
                    </th>
                    <th>
                        <div style="width:100px;"></div>
                    </th>
                    <th>
                        <div style="width:100px;"></div>
                    </th>
                </thead>
                <tbody>
                    <tr >
                        <td>
                            <h3 class="mb-0">Full Name</h3>
                        </td>
                        <td>
                            <button class="add_button" @click="toggleButton('name')" :class="{ 'active-button': activeButtons['name'] }">Add</button>
                        </td>
                        
                            <td>
                                <div v-if="activeButtons['name']" class="customer_required d-flex align-items-center">
                                    <label for="flexRadioDefault1">
                                        Required
                                    </label>
                                    <input class="ms-2" type="radio" id="flexRadioDefault1" v-model="selectedOption['name']" value="required" @change="updateField('name')">
                                </div>
                            </td>
                            <td>
                                <div v-if="activeButtons['name']" class="customer_required d-flex align-items-center">
                                    <label for="flexRadioDefault2">
                                        Optional
                                    </label>
                                    <input class="ms-2" type="radio" id="flexRadioDefault2" v-model="selectedOption['name']" value="optional" @change="updateField('name')">
                                </div>
                            </td>
                        
                    </tr>

                    <tr>
                        <td>
                            <h3 class="mb-0">Email Id</h3>
                        </td>
                        <td>
                            <button class="add_button" @click="toggleButton('email')" :class="{ 'active-button': activeButtons['email'] }">Add</button>
                        </td>
                        <td>
                            <div v-if="activeButtons['email']" class="customer_required d-flex align-items-center">
                                <label for="flexRadioDefault3">
                                    Required
                                </label>
                                <input class=" ms-2" type="radio" id="flexRadioDefault3" v-model="selectedOption['email']" value="required" @change="updateField('email')">
                            </div>
                        </td>
                        <td>
                            <div v-if="activeButtons['email']" class="customer_required d-flex align-items-center">
                                <label for="flexRadioDefault4">
                                    Optional
                                </label>
                                <input class=" ms-2" type="radio" id="flexRadioDefault4" v-model="selectedOption['email']" value="optional" @change="updateField('email')">
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h3 class="mb-0">Phone Number</h3>
                        </td>
                        <td>
                            <button class="add_button" @click="toggleButton('phone')" :class="{ 'active-button': activeButtons['phone'] }">Add</button>
                        </td>
                        <td>
                            <div v-if="activeButtons['phone']" class="customer_required d-flex align-items-center">
                                <label for="flexRadioDefault5">
                                    Required
                                </label>
                                <input class=" ms-2" type="radio" id="flexRadioDefault5" v-model="selectedOption['phone']" value="required" @change="updateField('phone')">
                            </div>
                        </td>
                        <td>
                            <div v-if="activeButtons['phone']" class="customer_required d-flex align-items-center">
                                <label for="flexRadioDefault6">
                                    Optional
                                </label>
                                <input class=" ms-2" type="radio" id="flexRadioDefault6" v-model="selectedOption['phone']" value="optional" @change="updateField('phone')">
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h3 class="mb-0">Company/ Organization name</h3>
                        </td>
                        <td>
                            <button class="add_button" @click="toggleButton('company')" :class="{ 'active-button': activeButtons['company'] }">Add</button>
                        </td>
                        <td>
                            <div v-if="activeButtons['company']" class="customer_required d-flex align-items-center">
                                <label for="flexRadioDefault7">
                                    Required
                                </label> 
                                <input class=" ms-2" type="radio" id="flexRadioDefault7" v-model="selectedOption['company']" value="required" @change="updateField('company')">
                            </div>
                        </td>
                        <td>
                            <div v-if="activeButtons['company']" class="customer_required d-flex align-items-center">
                                <label for="flexRadioDefault8">
                                    Optional
                                </label>
                                <input class=" ms-2" type="radio" id="flexRadioDefault8" v-model="selectedOption['company']" value="optional" @change="updateField('company')">
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h3 class="mb-0">Job Title</h3>
                        </td>
                        <td>
                            <button class="add_button" @click="toggleButton('job_titles')" :class="{ 'active-button': activeButtons['job_titles'] }">Add</button>
                        </td>
                        <td>
                            <div v-if="activeButtons['job_titles']" class="customer_required d-flex align-items-center">
                                <label for="flexRadioDefault9">
                                    Required
                                </label>
                                <input class=" ms-2" type="radio" id="flexRadioDefault9" v-model="selectedOption['job_titles']" value="required" @change="updateField('job_titles')">
                            </div>
                        </td>
                        <td>
                            <div v-if="activeButtons['job_titles']" class="customer_required d-flex align-items-center">
                                <label for="flexRadioDefault10">
                                    Optional
                                </label>
                                <input class=" ms-2" type="radio" id="flexRadioDefault10" v-model="selectedOption['job_titles']" value="optional" @change="updateField('job_titles')">
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h3 class="mb-0">Address</h3>
                        </td>
                        <td>
                            <button class="add_button" @click="toggleButton('address')" :class="{ 'active-button': activeButtons['address'] }">Add</button>
                        </td>
                        <td>
                            <div v-if="activeButtons['address']" class="customer_required d-flex align-items-center">
                                <label for="flexRadioDefault11">
                                    Required
                                </label>
                                <input class=" ms-2" type="radio" id="flexRadioDefault11" v-model="selectedOption['address']" value="required" @change="updateField('address')">
                            </div>
                        </td>
                        <td>
                            <div v-if="activeButtons['address']" class="customer_required d-flex align-items-center">
                                <label for="flexRadioDefault12">
                                    Optional
                                </label>
                                <input class=" ms-2" type="radio" id="flexRadioDefault12" v-model="selectedOption['address']" value="optional" @change="updateField('address')">
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h3 class="mb-0">Birth Date</h3>
                        </td>
                        <td>
                            <button class="add_button" @click="toggleButton('birth_date')" :class="{ 'active-button': activeButtons['birth_date'] }">Add</button>
                        </td>
                        <td>
                            <div v-if="activeButtons['birth_date']" class="customer_required d-flex align-items-center">
                                <label for="flexRadioDefault13">
                                    Required
                                </label>
                                <input class=" ms-2" type="radio" id="flexRadioDefault13" v-model="selectedOption['birth_date']" value="required" @change="updateField('birth_date')">
                            </div>
                        </td>
                        <td>
                            <div v-if="activeButtons['birth_date']" class="customer_required d-flex align-items-center">
                                <label for="flexRadioDefault14">
                                    Optional
                                </label>
                                <input class=" ms-2" type="radio" id="flexRadioDefault14" v-model="selectedOption['birth_date']" value="optional" @change="updateField('birth_date')">
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h3 class="mb-0">Gender</h3>
                        </td>
                        <td>
                            <button class="add_button" @click="toggleButton('gender')" :class="{ 'active-button': activeButtons['gender'] }">Add</button>
                        </td>
                        <td>
                            <div v-if="activeButtons['gender']" class="customer_required d-flex align-items-center">
                                <label for="flexRadioDefault15">
                                    Required
                                </label>
                                <input class=" ms-2" type="radio" id="flexRadioDefault15" v-model="selectedOption['gender']" value="required"  @change="updateField('gender')">
                            </div>
                        </td>
                        <td>
                            <div v-if="activeButtons['gender']" class="customer_required d-flex align-items-center">
                                <label for="flexRadioDefault16">
                                    Optional
                                </label>
                                <input class=" ms-2" type="radio" id="flexRadioDefault16" v-model="selectedOption['gender']" value="optional" @change="updateField('gender')">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            <input class="customer_table_submit" @click="submitSelectedFields()" type="submit" value="Submit">
        </div>
    </div>

</div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            selectedFields: [],
            activeButtons: {},
            selectedOption: {},
        };
    },
    created() {
    // Load the activeButtons status from local storage on component creation
    const savedActiveButtons = localStorage.getItem('activeButtons');
    if (savedActiveButtons) {
      this.activeButtons = JSON.parse(savedActiveButtons);
    }
    const savedSelectedOptions = localStorage.getItem('selectedOptions');
    if (savedSelectedOptions) {
      this.selectedOption = JSON.parse(savedSelectedOptions);
    }
  },
    methods: {
        toggleButton(fieldName) {
      const isActive = !this.activeButtons[fieldName];
      this.$set(this.activeButtons, fieldName, isActive);
      localStorage.setItem('activeButtons', JSON.stringify(this.activeButtons));

      // Make a separate Axios call for each field
      const valueToSend = isActive ? '1' : '0';
      axios.get(`../wp-admin/admin-ajax.php?action=chatbot_display_from_test`, {
        params: {
          fieldName,
          value: valueToSend,
        },
      })
      .then((response) => {
        console.log(`Axios response for ${fieldName}:`, response);
      })
      .catch((error) => {
        console.error(`Axios error for ${fieldName}:`, error);
      });
    },
        addField(fieldName) {
            console.log(fieldName);
            // Add the selected field to the selectedFields array
            this.selectedFields.push(fieldName);
        },
        submitSelectedFields() {
            // Send the selected fields to your PHP script
            axios.get('/wordpress_test/wordpressvue/wp-admin/admin-ajax.php?action=chatbot_display_interface', {
                    params: {
                        selectedFields: this.selectedFields
                    }
                })
                .then(response => {
                    console.log('AJAX response received:', response);
                    console.log(response.data);
                })
                .catch(error => {
                    console.error(error);
                });
        },
        
        updateField(fieldName) {
        // Get the selected value for the given field
        const selectedValue = this.selectedOption[fieldName];
        
        // Define the value to send to PHP (1 for Required, 0 for Optional)
        const valueToSend = selectedValue === 'required' ? '1' : '0';

        // Make an Axios call to send the value to PHP
        axios.get('../wp-admin/admin-ajax.php?action=chatbot_display_optional_test', {
            params: {
                fieldName,
                value: valueToSend,
            },
        })
        .then((response) => {
            console.log(`Axios response for ${fieldName}:`, response);
        })
        .catch((error) => {
            console.error(`Axios error for ${fieldName}:`, error);
        });
    },
    },
    watch: {
    // Watch for changes in selectedOption and save it to local storage
    selectedOption: {
      handler() {
        localStorage.setItem('selectedOptions', JSON.stringify(this.selectedOption));
      },
      deep: true,
    },
},
};
</script>
<style scoped>
.active-button {
    background-color: #007BD9;
    color: #fff;
    transition: 0.3s;
  }
  .active-button:hover {
    background-color: #ffffff;
    color: #007BD9;
    transition: 0.3s;
    border: 2px solid #007BD9;
  }
  .inactive-button {
    border: 2px solid #007BD9;
    background-color: #fff;
    padding: 5px 15px;
    color: #007BD9;
    transition: 0.3s;
    border-radius: 5px;
    font-size: 12px;
    font-weight: 500;
  }
</style>


