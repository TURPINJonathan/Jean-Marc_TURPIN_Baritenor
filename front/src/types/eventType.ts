export interface  EventType  {
  label: string,
  details?: string,
  geoCoordinates: number[],
  type: string,
  date: Date,
  startAt: string,
  endAt?: string
}
