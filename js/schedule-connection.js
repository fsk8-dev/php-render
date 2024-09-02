const SCHEDULE_BASE_URL = "https://schedule-api.fsk8.ru/api/";

function getLocationList() {
  return fetch(`${SCHEDULE_BASE_URL}locations`)
    .then((response) => {
      return response.json();
    })
    .catch((error) => {
      console.error(error);
    });
}

function getSchedule(id) {
  return fetch(`${SCHEDULE_BASE_URL}location-schedules/${id}`)
    .then((response) => {
      return response.json();
    })
    .catch((error) => {
      console.error(`${error} error`);
      return error;
    });
}

(() => {
  getSchedule(1)
    .then((locations) => {
      console.log(locations);
    })
    .catch((error) => {
      console.error(`${error} get`);
    });
})();

/**
ENDPOINTS
get: '/locations'
get: '/locations/{id}'
get: '/cities'
get: '/location-schedules'
get: '/location-schedules/{id}'
post:'/location-schedules/store/{id}'
post:'/location-schedules/update/{id}'
 */
