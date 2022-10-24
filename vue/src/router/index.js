import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "../views/Dashboard.vue";
import PatientDashboard from "../views/patient/PatientDashboard.vue"
import DoctorDashboard from "../views/doctor/DoctorDashboard.vue"
import Surveys from "../views/Surveys.vue";
import SurveyView from "../views/SurveyView.vue";
import Login from "../views/Login.vue";
import Register from "../views/Register.vue";
import NotFound from "../views/NotFound.vue";
import SurveyPublicView from "../views/SurveyPublicView.vue";
import DefaultLayout from "../components/DefaultLayout.vue";
import AuthLayout from "../components/AuthLayout.vue";
import store from "../store";
import PatientProfile from "../views/patient/PatientProfile.vue"
import FindUs from "../views/patient/FindUs.vue"
import FindDoctor from "../views/patient/FindDoctor.vue"
import MedicalHistory from "../views/patient/MedicalHistory.vue"
import MyPrescription from "../views/patient/MyPrescription.vue"
import GroupAdminDashboard from "../views/group_admin/GroupAdminDashboard.vue"
import GroupAdminDefaultLayout from "../components/GroupAdminDefaultLayout.vue"
import GroupAdminCreateAccount from "../views/group_admin/GroupAdminCreateAccount.vue"
import PatientMakeAppointment from "../views/patient/PatientMakeAppointment.vue"
import MyAppointment from "../views/patient/MyAppointment.vue"
import PatientEditProfile from"../views/patient/PatientEditProfile.vue"
import ViewArticle from "../views/patient/ViewArticle.vue"
import MedicalAdminDefaultLayout from "../components/MedicalAdminDefaultLayout.vue"
import MedicalAdminCreateNewsArticle from "../views/medical_admin/MedicalAdminCreateNewsArticle.vue"
import MedicalAdminDashboard from "../views/medical_admin/MedicalAdminDashboard.vue"
import GroupAdminCreateInstitute from "../views/group_admin/GroupAdminCreateInstitute.vue"
import GroupAdminCreateSpecialty from "../views/group_admin/GroupAdminCreateSpecialty.vue"


let routes = [{
  path: "/",
  redirect: "/patient-dashboard",
  component: DefaultLayout,
  meta: { requiresAuth: true },
  children: [
    { path: "/dashboard", name: "Dashboard", component: Dashboard },
    { path: "/patient-dashboard", name: "PatientDashboard", component: PatientDashboard },
    { path: "/patient-profile", name: "PatientProfile", component: PatientProfile },
    { path: "/find-us", name: "FindUs", component: FindUs },
    { path: "/find-doctor", name: "FindDoctor", component: FindDoctor },
    { path: "/medical-history", name: "MedicalHistory", component: MedicalHistory },
    { path: "/my-prescription", name: "MyPrescription", component: MyPrescription },
    { path: "/my-appointment", name: "MyAppointment", component: MyAppointment },
    { path: "/patient-make-appointment", name: "PatientMakeAppointment", component: PatientMakeAppointment },
    { path: "/patient-edit-profile", name: "PatientEditProfile", component: PatientEditProfile },
    { path: "/patient-view-article", name: "ViewArticle", component: ViewArticle },
    { path: "/doctor-dashboard", name: "DoctorDashboard", component: DoctorDashboard },
    { path: "/surveys", name: "Surveys", component: Surveys },
    { path: "/surveys/create", name: "SurveyCreate", component: SurveyView },
    { path: "/surveys/:id", name: "SurveyView", component: SurveyView },
  ],
},
{
  path: "/m",
  redirect: "/medical-admin-dashboard",
  component: MedicalAdminDefaultLayout,
  meta: { requiresAuth: true },
  children: [
    { path: "/medical-admin-dashboard", name: "MedicalAdminDashboard", component: MedicalAdminDashboard },
    { path: "/medical-admin-create-news-article", name: "MedicalAdminCreateNewsArticle", component: MedicalAdminCreateNewsArticle },
  ],
},
{
  path: "/g",
  redirect: "/group-admin-dashboard",
  component: GroupAdminDefaultLayout,
  meta: { requiresAuth: true },
  children: [
    { path: "/group-admin-dashboard", name: "GroupAdminDashboard", component: GroupAdminDashboard },
    { path: "/group-admin-create-account", name: "GroupAdminCreateAccount", component: GroupAdminCreateAccount },
    { path: "/group-admin-create-institute", name: "GroupAdminCreateInstitute", component: GroupAdminCreateInstitute },
    { path: "/group-admin-create-specialty", name: "GroupAdminCreateSpecialty", component: GroupAdminCreateSpecialty },
  ],
},
{
  path: "/view/survey/:slug",
  name: 'SurveyPublicView',
  component: SurveyPublicView
},
{
  path: "/auth",
  redirect: "/login",
  name: "Auth",
  component: AuthLayout,
  meta: { isGuest: true },
  children: [
    {
      path: "/login",
      name: "Login",
      component: Login,
    },
    {
      path: "/register",
      name: "Register",
      component: Register,
    },
  ],
},
{
  path: '/404',
  name: 'NotFound',
  component: NotFound
}];



const router = createRouter({
  history: createWebHistory(),
  routes,
});


router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.state.user.token) {
    next({ name: "Login" });
  } else if (store.state.user.token && to.meta.isGuest) {
    next({ name: "PatientDashboard" });
  } else {
    next();
    
  }
});

export default router;
