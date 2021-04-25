export default {
    isStartDateBeforeEndDate(startDate, endDate) {
        return new Date(startDate).getTime() < new Date(endDate).getTime();
    },
};
