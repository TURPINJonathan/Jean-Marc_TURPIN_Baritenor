import type DateType from '@types/datesType'

export function useDateUtils() {
  /**
   * Usage: Get the current date
   */
  function getCurrentDate(): Date {
    return new Date();
  }

  /**
   * Usage: Get the current month (by default) or other date with specific format (long by default)
   * @param date 
   * @param format 
   * @returns string
   */
  function getMonth(date: Date = getCurrentDate() as Date, format: DateType['formats'] = 'long'): string {
    const validFormats = ["numeric", "2-digit", "narrow", "short", "long"] as DateType['formats'][];

    if (!validFormats.includes(format)) {
      throw new Error("Format invalide pour le mois");
    }
    const options: Intl.DateTimeFormatOptions = {
			month: format as DateType,
		};
    return date.toLocaleDateString('fr-FR', options);
  }

  /**
   * Usage: Get the current year (by default) or other date with specific format (numeric by default)
   * @param date 
   * @param format 
   * @returns 
   */
  function getYear(date: Date = getCurrentDate() as Date, format: DateType['formats'] = 'numeric'): string {
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
