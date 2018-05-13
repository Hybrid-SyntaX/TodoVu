<style>
.task {
  border-radius: 0px;
}
</style>
<template>

  <div class="columns ">
    <div class="column">

      
        <div class="field has-addons ">
          <div class="control">
            <input v-model="newTask.name" placeholder="Add new task" class="input is-7" />
          </div>
          <div class="control">
            <button class="button is-info" @click.stop="save">
              <i class="fa fa-plus" />
            </button>
          </div>
        </div>
      

      <ul class="column is-4">
        <li v-for="task in tasks" v-bind:key="task.id" @click="select(task)" :class="['box','task','is-marginless',selectedClass(task),completedTaskClass(task)]">

          <div class="field is-grouped columns">
            <div class="field is-grouped column  is-8">
              <button class="button is-small" @click="toggleCompletion(task)" style="margin:0px 10px 0px 0px">
                <i class="fa" :class="taskCompletionButtonClass(task)" />
              </button>
              <input type="text" v-model="task.name" class="input is-size-6 is-marginless" @click.stop="" v-if="modes.edit && isSelected(task)">
              <span class="is-size-6 is-marginless" v-else> {{task.name}}</span>
            </div>
            <div class="buttons has-addons is-marginess is-pulled-right" v-if="isSelected(task)">

              <!-- edit buttons -->
              <template v-if="!modes.delete">
                <button class="button is-marginless is-small" @click.stop="modes.edit=true" v-if="!modes.edit">
                  <i class="fa fa-edit" />
                </button>
                <!-- buttons -->
                <div class="buttons has-addons is-marginless" v-if="modes.edit">
                  <button class="button  is-small" @click.stop="modes.edit=false">
                    <i class="fa fa-ban" />
                  </button>
                  <button class="button is-primary is-small" @click.stop="edit">
                    <i class="fa fa-save" />
                  </button>
                </div>
              </template>
              <!-- delete button -->
              <template v-if="!modes.edit">
                <button class="button is-marginless is-small" v-if="!modes.delete">
                  <i class="fa fa-times" @click.stop="modes.delete=true" />
                </button>
                <!-- buttons -->
                <div class="buttons has-addons is-marginless" v-else>
                  <button class="button is-small" @click.stop="modes.delete=false">
                    <i class="fa fa-ban" />
                  </button>
                  <button class="button is-danger is-small">
                    <i class="fa fa-trash" @click.stop="remove" />
                  </button>
                </div>
              </template>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  async mounted() {
    console.log("Component mounted.");
    await this.populateTasks();
    console.log("Running in ", process.env.NODE_ENV);
  },
  data() {
    return {
      API_ENDPOINT:
        window.location.hostname === "todovu.herokuapp.com"
          ? "https://todovu.herokuapp.com/api/tasks/"
          : "/api/tasks/",
      modes: {
        edit: false,
        delete: false
      },
      tasks: [],
      newTask: {
        name: null
      },
      selectedTask: {}
    };
  },
  computed: {},
  methods: {
    taskCompletionButtonClass(t) {
      return {
        "fa-check": t.completionDate,
        "fa-square": !t.completionDate
      };
    },
    isSelected: function(t) {
      return t.id === this.selectedTask.id;
    },
    cancelAllModes() {
      this.modes.delete = false;
      this.modes.edit = false;
    },
    completedTaskClass: function(t) {
      if (t) return { "has-text-success": t.completionDate };
    },
    selectedClass: function(t) {
      if (t) return { "has-background-light	": t.id === this.selectedTask.id };
    },
    async populateTasks() {
      this.tasks = await this.readAll();
    },
    select: function(t) {
      this.cancelAllModes();
      this.selectedTask = t;
      console.log(this.selectedTask.id);
    },
    remove: async function(e) {
      e.stopPropagation();
      const response = await axios.delete(
        this.API_ENDPOINT + this.selectedTask.id
      );
      if (response) await this.populateTasks();
      this.modes.delete = false;
    },
    readAll: async function() {
      var response = await axios.get(this.API_ENDPOINT);
      return response.data;
    },
    toggleCompletion: async function(task) {
      var uri =
        this.API_ENDPOINT +
        task.id +
        (task.completionDate ? "/undone" : "/done");
      const response = await axios.patch(uri);
      if (response) await this.populateTasks();
    },
    save: async function(e) {
      e.stopPropagation();
      const response = await axios.post(this.API_ENDPOINT, this.newTask);
      if (response) {
        await this.populateTasks();
        this.newTask.name = null;
      }
    },
    edit: async function() {
      const response = await axios.put(
        this.API_ENDPOINT + this.selectedTask.id,
        this.selectedTask
      );
      if (response) {
        await this.populateTasks();
        this.modes.edit = false;
      }
    }
  }
};
</script>
