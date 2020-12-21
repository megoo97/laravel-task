<template>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Agencie</th>
        <th scope="col">Title</th>
        <th scope="col">Content</th>
        <th class="sort-title" scope="col" @click="ratingSort">
          Rating
          <font-awesome-icon
            :icon="this.rateAsc ? ['fas', 'arrow-down'] : ['fas', 'arrow-up']"
          />
        </th>
        <th class="sort-title" scope="col" @click="dateTimeSort">
          datetime
          <font-awesome-icon
            :icon="this.dateAsc ? ['fas', 'arrow-down'] : ['fas', 'arrow-up']"
          />
        </th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in dailyNews" :key="item.id">
        <td scope="col">{{ index + 1 }}</td>
        <td scope="col">{{ item.agencie }}</td>
        <td scope="col">{{ item.title }}</td>
        <td scope="col">{{ item.content }}</td>
        <td scope="col">{{ item.rating }}</td>
        <td scope="col">{{ item.datetime }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  data() {
    return {
      dateAsc: false,
      rateAsc: false,
      dailyNews: [],
      news: [],
    };
  },
  methods: {
    dateTimeSort() {
      if (this.dateAsc) {
        axios
          .get("/api/dailyNews/filter", {
            params: {
              date: "true",
              date_sort: "DESC",
            },
          })
          .then((res) => {
            this.dailyNews = res.data;
                });
      } else {
        axios
          .get("/api/dailyNews/filter", {
            params: {
              date: "true",
              date_sort: "ASC",
            },
          })
          .then((res) => {
            this.dailyNews = res.data;
                });
      }

      this.dateAsc = !this.dateAsc;
    },

    ratingSort() {
      if (this.rateAsc) {
        axios
          .get("/api/dailyNews/filter", {
            params: {
              rating: "true",
              rating_sort: "DESC",
            },
          })
          .then((res) => {
            this.dailyNews = res.data;
                });
      } else {
        axios
          .get("/api/dailyNews/filter", {
            params: {
              rating: "true",
              rating_sort: "ASC",
            },
          })
          .then((res) => {
            this.dailyNews = res.data;
                });
      }

      this.rateAsc = !this.rateAsc;
    },
  },
  computed: {},
  mounted() {
    axios.get("/api/dailyNews").then((res) => {
      this.dailyNews = res.data;
    });
  },
};
</script>
<style scoped>
.sort-title:hover {
  cursor: pointer;
}
</style>
