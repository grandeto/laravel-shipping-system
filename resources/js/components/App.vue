<template>
    <div id="content">
        <p>Please use the following combinations to test the app:</p>
        <ol>
            <li><strong>Origin country:</strong> USA; <strong>Destination country:</strong> Denmark; <strong>Weight:</strong> min 10 - max 20</li>
            <li><strong>Origin country:</strong> Denmark; <strong>Destination country:</strong> Bulgaria; <strong>Weight:</strong> min 5 - max 10</li>
        </ol>
        <el-row type="flex">
            <el-col :offset="4" :span="20">
                <el-select
                    v-model="origin"
                    placeholder="Origin country"
                    :disabled="muteActions"
                    @change="compareData.origin_country_id = origin; trackChange()">
                    <el-option
                        v-for="country in countries"
                        :key="country.id"
                        :label="country.name"
                        :value="country.id"
                        :origin="this.value">
                    </el-option>
                </el-select>
            </el-col>
            <el-col :span="20">
                <el-select
                    v-model="destination"
                    placeholder="Destination country"
                    :disabled="muteActions"
                    @change="compareData.destination_country_id = destination; trackChange()">
                    <el-option
                        v-for="country in countries"
                        :key="country.id"
                        :label="country.name"
                        :value="country.id"
                        :destination="this.value">
                    </el-option>
                </el-select>
            </el-col>
            <el-col :span="14">
                <el-input
                    class="weight-sh"
                    type="number"
                    :disabled="muteActions"
                    size="medium"
                    :span="6"
                    placeholder="Weight (kg)"
                    v-model="compareData.weight"
                    @input="trackChange">
                </el-input>
            </el-col>
                <el-button
                    class="compare-sh"
                    :disabled="muteActions || muteCompare"
                    @click="compare(compareData)">
                    Compare
                </el-button>
            <el-col>
            </el-col>
        </el-row>
        <el-row v-if="showResults" type="flex">
            <shippments
            :no-shippments="noShippments"
            :prices="prices"
            >
            </shippments>
        </el-row>
    </div>
</template>

<script>

import ShippmentsComponent from './ShippmentsComponent.vue';

    export default {
        data() {
            return {
                countries: [],
                prices: [],
                noShippments: "Fetching shipping methods. Please wait...",
                compareData: {
                    origin_country_id: '',
                    destination_country_id: '',
                    weight: ''
                },
                muteActions: false,
                muteCompare: true,
                origin: '',
                destination: '',
                showResults: false

            }
        },
        methods: {
            trackChange() {
                if (this.compareData.origin_country_id != '' && this.compareData.destination_country_id != '' && this.compareData.weight != '') {
                    this.muteCompare = false;
                } else {
                    this.muteCompare = true;
                }
            },
            getAll() {
                this.muteActions = true;
                window.axios.get('/api/countries').then(({ data }) => {
                    data.forEach(country => {
                        this.countries.push(country);
                    });
                    this.muteActions = false;
                }).catch(error => {
                    this.$message({
                        showClose: true,
                        dangerouslyUseHTMLString: true,
                        message: this.handleErrorMessages(error),
                        type: 'error',
                        duration: 5000
                    });
                    this.muteActions = false;
                });
            },
            compare(data) {
                this.muteActions = true;
                this.showResults = false;
                window.axios.post('/api/compare/', data).then(({ data }) => {
                    this.prices = data;
                    this.showResults = true;
                    this.muteActions = false;
                }).catch(error => {
                    this.noShippments = "No shipping methods found."
                    this.$message({
                        showClose: true,
                        dangerouslyUseHTMLString: true,
                        message: this.handleErrorMessages(error),
                        type: 'error',
                        duration: 5000
                    });
                    this.muteActions = false;
                });;
            },
            handleErrorMessages(error) {
                if (error.response !== undefined) {
                    let errors = error.response.data.message;
                    if (typeof(errors) === "string") {
                        return errors;
                    } else {
                        let ul = '<ul>';
                        for (let i in errors) {
                            ul+= '<li>' + errors[i][0] + '</li>';
                        }
                        return ul+= '</ul>';
                    }
                } else {
                    console.log('error:', error);
                    return 'An error occurred! Please try again later';
                }
            }
        },
        components: {
            'shippments': ShippmentsComponent
        },
        created() {
            this.getAll();
        }
    }
</script>
