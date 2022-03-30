<template>
  <div>
    <form class="container" @submit.prevent="handleSubmit">
      <div style="width: 50%">
        <div class="form-group mt-3">
          <label for="long-link">Long Link</label>
          <input
            type="url"
            class="form-control"
            id="long-link"
            placeholder="Long Link"
            v-model="longLink"
            required
          />
        </div>
        <button type="submit" class="btn btn-success mt-1">
          <span
            v-if="loading"
            class="spinner-border spinner-border-sm"
            role="status"
            aria-hidden="true"
          ></span>
          Make Short Link
        </button>
        <br />

        <div v-if="shortLink" class="alert alert-success" role="alert">
          <a target="_blank" :href="shortLink">{{ shortLink }}</a>
        </div>
        <div v-if="longLinkError" class="alert alert-danger" role="alert">
          {{ longLinkError }}
        </div>
      </div>
    </form>
  </div>
</template>

<script>
const shortLinkUrl = process.env.MIX_API_SHORT_URL;
export default {
  data() {
    return {
      longLink: "",
      shortLink: "",
      loading: false,
      longLinkError: "",
    };
  },
  methods: {
    handleSubmit() {
      this.loading = true;
      this.shortLink = "";
      this.longLinkError = "";
      axios
        .post("api/shortLink", {
          long_link: this.longLink,
        })
        .then((res) => {
          this.shortLink = `${shortLinkUrl}/${res.data.key}`;
        })
        .catch((error) => {
          try {
            this.longLinkError = error.response.data.errors.long_link[0];
          } catch (error) {}
          console.log(error);
        }).finally(() => {
          this.loading = false;
        })
    },
  },
};
</script>
