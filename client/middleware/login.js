export default async function ({ store, redirect, router }) {
  if (store.state.auth.loggedIn) {
    if (store.state.auth.strategy == "userAuth") {
      return redirect("/user/dashboard");
    }
    return redirect("/admin/dashboard");
  }
}
