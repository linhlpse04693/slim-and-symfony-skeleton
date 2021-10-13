const routeOption = (route, key, value) => {
  return route.matched.some((m) => {
    if (process.client) {
      return Object.values(m.components).some((component) => component.options && component.options[key] === value);
    } else {
      return Object.values(m.components).some((component) => Object.values(component._Ctor).some((ctor) => ctor.options && ctor.options[key] === value));
    }
  });
}

const getMatchedComponents = (route, matches = []) => {
  return [].concat(...[], ...route.matched.map(function (m, index) {
    return Object.keys(m.components).map(function (key) {
      matches.push(index);
      return m.components[key];
    });
  }));
}

export default ({ redirect, store, route, $config }) => {
  if (routeOption(route, "auth", false)) {
    return;
  }
  const matches = [];
  const Components = getMatchedComponents(route, matches);
  if (!Components.length) {
    return;
  }
  const pageIsInGuestMode = routeOption(route, "auth", "guest");

  if (pageIsInGuestMode) {
    if (!store.state.auth.token) {
      return;
    }

    redirect($config.redirect.home);
  }

  if (store.state.auth.token) {
    return;
  }

  redirect($config.redirect.login)
}

