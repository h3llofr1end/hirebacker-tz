<template>
    <div class="form" style="display:flex; align-items:center; justify-content:center">
        <div class="form-inner" style="margin:0">
                <div class="form-group">
                    <input type="text" class="form-control" @change="makeDirty('name')" v-model="params.name" placeholder="Your name">
                </div>
                <div class="form-group">
                    <select class="form-control" @change="makeDirty('profession')" id="exampleFormControlSelect1" v-model="params.profession">
                    <option value="">Select profession</option>
                    <option v-for="profession in professionsList">{{ profession.value }}</option>
                </select>
                </div>
                <div v-for="(param, index) in params.params" style="margin-bottom:20px">
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="param.work" placeholder="Position" />
                    </div>
                    <div class="form-group">
                        <input name="from" type="date" @change="makeDirty(index)" v-model="param.start" placeholder="From" />
                        <input name="to" type="date"  @change="makeDirty(index)" v-model="param.end" placeholder="To" />
                    </div>
                    <textarea class="form-control" @change="makeDirty(index)" v-model="param.summary" rows="3" placeholder="Summary"></textarea>
                </div>
                <button type="button" @click="appendFields" class="btn btn-secondary float-left">+</button>
                <button style="margin-left: 10px" v-if="this.id !== null" type="button" @click="deleteRecord" class="btn btn-danger">Delete</button>
                <button type="submit" @click="submit" class="btn btn-primary float-right">Save</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                id: null,
                professionsList: [
                    {value: 'Бармен-кассир'},
                    {value: 'Главный бухгалтер'},
                    {value: 'Руководитель SMM-проектов'},
                    {value: 'Заместитель директора'},
                    {value: 'Музыкальный руководитель'},
                    {value: 'Персональный тренер'},
                    {value: 'Специалист по продажам'},
                    {value: 'Менеджер интернет-магазина'},
                    {value: 'Продавец-консультант'},
                    {value: 'Парикмахер'}
                ],
                params: [],
                dirty: [],
                colorAlert: ''
            }
        },
        mounted() {
            axios
                .get('/api/user-data')
                .then(response => {
                    if(response.data.params) {
                        this.params = response.data.params;
                        this.id = response.data.id;
                    } else {
                        this.appendFields();
                    }
                })
        },
        methods: {
            appendFields: function() {
                this.dirty.push(this.params.params.length);
                this.params.params.push({
                    end:"",
                    start:"",
                    summary:"",
                    work:""
                });
            },
            submit: function() {
                let url = (this.id === null) ? '/api/user-data' : '/api/user-data/'+this.id;
                let data = {
                    params: this.params,
                    dirty: this.dirty
                };
                if(this.id === null) {
                    axios.post(url, data).then(response => {
                        this.dirty = [];
                        this.id = response.data.id;
                        this.openAlert('success', 'You succesfully added data', 'You succesfully added data!');
                    })
                } else {
                    axios.put(url, data).then(response => {
                        this.dirty = [];
                        this.id = response.data.id;
                        this.openAlert('success', 'You succesfully updated data', 'You succesfully updated data!');
                    })
                }
            },
            makeDirty: function(index) {
                if(!this.dirty.includes(index)) this.dirty.push(index);
            },
            deleteRecord: function() {
                if(confirm('Are you really wanna to delete record?')) {
                    axios.delete('/api/user-data/'+this.id).then(response => {
                        this.id = null;
                        this.params = [];
                        this.dirty = [];
                    });
                }

            },
            openAlert(color, title, text){
                this.colorAlert = color;
                this.$vs.dialog({
                    color:this.colorAlert,
                    title: title,
                    text: text,
                })
            },
        }
    }
</script>
