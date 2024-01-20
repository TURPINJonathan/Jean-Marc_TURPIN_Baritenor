import type DateType from '@types/datesType'

export function useDateUtils() {
  function getCurrentDate() {
    return new Date();
  }

  function getMonth(date = getCurrentDate(), format: DateType['formats'] = 'long') {
    const validFormats = ["numeric", "2-digit", "narrow", "short", "long"] as DateType['formats'][];

    if (!validFormats.includes(format)) {
      throw new Error("Format invalide pour le mois");
    }
    const options: Intl.DateTimeFormatOptions = {
			month: format as DateType,
		};
    return date.toLocaleDateString('fr-FR', options);
  }

  function getYear(date = getCurrentDate(), format: DateType['formats'] = 'numeric') {
    const validFormats = ["numeric", "2-digit", "narrow", "short", "long"] as DateType['formats'][];

    if (!validFormats.includes(format)) {
      throw new Error("Format invalide pour le mois");
    }
    const options: Intl.DateTimeFormatOptions = {
			year: format as DateType,
		};
    return date.toLocaleDateString('fr-FR', options);
  }

  return {
    getCurrentDate,
    getMonth,
    getYear
  };
}
