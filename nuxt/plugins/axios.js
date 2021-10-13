export default function ({ $axios, $config, store: { state } }) {
  $axios.setBaseURL($config.axios.browserBaseURL);

  $axios.onRequest((config) => {
    config.headers = {
      "Authorization": state.auth.token ? "Bearer " + state.auth.token : "",
    };
  });

  $axios.onResponse(response => response.data);
}
